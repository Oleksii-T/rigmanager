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
            // Skip posts if Mailer and post belong to same user or if type of post is inapropriate
            if ( $mailer->user_id != $this->post->user_id && array_key_exists($this->post->type, $mailer->types_map) ) {
                // If keywords are configured in Mailer 
                if ($mailer->keywords && $this->checkKeywords($mailer) ) {
                    continue;
                }
                // If authors are configured in Mailer 
                if ($mailer->authors_encoded && $this->checkAuthors($mailer) ) {
                    continue;
                }
                // If tags are configured in Mailer 
                if ($mailer->tags_encoded && $this->ckeckTags($mailer) ) {
                    continue;
                }
            }
        }
    }

    private function checkKeywords($mailer) {
        foreach ( explode("\n", $mailer->keywords) as $keywords) {
            $keywords = str_replace("\r", '', $keywords);
            if ( mb_stristr($this->post->description, $keywords) ) {
                Mail::to($mailer->user->email)->send(new MailerNotification($this->post, 'keywords', $keywords, $mailer->user->language)); //send mail notification to user
                return true;
            }
        }
        return false;
    }

    private function checkAuthors($mailer) {
        // Iterate througth each subscribed author in Mailer
        foreach ($mailer->authors_encoded as $author) {
            if ($author == $this->post->user->id ) {
                Mail::to($mailer->user->email)->send(new MailerNotification($this->post, 'author', $this->post->user->name, $mailer->user->language)); //send mail notification to user
                return true;
            }
        }
        return false;
    }

    private function ckeckTags($mailer) {
        // Iterate througth each subscribed tag
        foreach ($mailer->tags_encoded as $tag) {
            $tagTMP = $tag;
            $tag = str_replace('.', '\.', $tag); // Escape dot in tags for regex
            $regex = "/^$tag(.[0-9]+)*$/"; // Create regex from tag
            // Check is tag of new post is comply with tag in Mailer
            if ( preg_match($regex, $this->post->tag_encoded) ) {
                Mail::to($mailer->user->email)->send(new MailerNotification($this->post, 'tags', $this->post->tag, $mailer->user->language)); //send mail notification to user
                return true;
            }
        }
        return false;
    }
}
