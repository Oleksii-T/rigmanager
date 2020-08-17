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
use App\Tags;

class MailersAnalizePost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Tags;

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
        foreach ( explode("\n", $mailer->keywords) as $string) {
            $string = str_replace("\r", '', $string);
            if ( mb_stristr($post->description, $string) ) {
                //dispatch(new MailerSendNotification($mailer->user->email, $post->id, 'keyword', $string)); // Dispatch job of sending a Notification to user
                Mail::to($mailer->user->email)->send(new MailerNotification($post, __('mailerNotifDescription'), $string)); //send mail notification to user
                return true;
            }
        }
        return false;
    }

    private function checkAuthors($mailer, $post) {
        // Iterate througth each subscribed author in Mailer
        foreach (explode(" ", $mailer->authors) as $author) {
            if ($author == $post->user->id ) {
                //dispatch(new MailerSendNotification($mailer->user->email, $post->id, 'author', $post->user->name)); // Dispatch job of sending a Notification to user
                Mail::to($mailer->user->email)->send(new MailerNotification($post, __('ui.mailerNotifAuthors'), $post->user->name)); //send mail notification to user
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
                //dispatch(new MailerSendNotification($mailer->user->email, $post->id, 'tag', $post->tag)); // Dispatch job of sending a Notification to user
                $tagsReadable = $this->getTagPathAsString($post->tag);
                Mail::to($mailer->user->email)->send(new MailerNotification($post, __('ui.mailerNotifTags'), $tagsReadable)); //send mail notification to user
                return true;
            }
        }
        return false;
    }
}
