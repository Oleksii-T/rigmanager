<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Post;
use App\Mailer;
//use App\Jobs\MailerSendNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailerNotification;

class MailersAnalizePost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 2;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 30;

    protected $post;
    protected $ignoreUserId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Post $post, $id)
    {
        $this->post = $post;
        $this->ignoreUserId = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mailers = Mailer::all()->where('is_active', true); // Get all active Mailers
        // Iterate througth Mailers
        foreach($mailers as $mailer) {
            // Skip posts if Mailer and post belong to same user
            if ($mailer->user_id != $this->post->user_id) {
                // If keywords are configured in Mailer 
                if ($mailer->keywords && $this->checkKeywords($mailer, $this->post) ) {
                    continue;
                }
                // If authors are configured in Mailer 
                if ($mailer->authors && $this->checkAuthors($mailer, $this->post) ) {
                    continue;
                }
                // If tags are configured in Mailer 
                if ($mailer->tags && $this->ckeckTags($mailer, $this->post) ) {
                    continue;
                }
            }
        }
    }

    private function checkKeywords($mailer, $post) {
        foreach ( explode("\n", $mailer->keywords) as $keywords) {
            $keywords = str_replace("\r", '', $keywords);
            if ( mb_stristr($post->description, $keywords) ) {
                Mail::to($mailer->user->email)->send(new MailerNotification($post, 'keywords', $keywords, $mailer->user->language)); //send mail notification to user
                return true;
            }
        }
        return false;
    }

    private function checkAuthors($mailer, $post) {
        // Iterate througth each subscribed author in Mailer
        foreach (explode(" ", $mailer->authors) as $author) {
            if ($author == $post->user->id ) {
                Mail::to($mailer->user->email)->send(new MailerNotification($post, 'author', $post->user->name, $mailer->user->language)); //send mail notification to user
                return true;
            }
        }
        return false;
    }

    private function ckeckTags($mailer, $post) {
        // Iterate througth each subscribed tag
        foreach (explode(" ", $mailer->tags) as $tag) {
            $tagTMP = $tag;
            $tag = str_replace('.', '\.', $tag); // Escape dot in tags for regex
            $regex = "/^$tag(.[0-9]+)*$/"; // Create regex from tag
            // Check is tag of new post is comply with tag in Mailer
            if ( preg_match($regex, $post->tag) ) {
                Mail::to($mailer->user->email)->send(new MailerNotification($post, 'tags', $post->tag, $mailer->user->language)); //send mail notification to user
                return true;
            }
        }
        return false;
    }
}
