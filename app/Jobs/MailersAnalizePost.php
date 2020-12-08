<?php

namespace App\Jobs;

use App\Http\Controllers\UsdExchangeController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailerNotification;
use Illuminate\Bus\Queueable;
use App\Mailer;
use App\Post;

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
        $mailers = Mailer::all()->where('is_active', true)->groupBy('user_id'); // Get all active Mailers
        // Iterate througth Mailers by user
        foreach($mailers as $userId => $userMailers) {
            // Skip posts if Mailer and post belong to same user
            if ( $userId == $this->post->user_id ) {
                continue;
            }
            foreach ($userMailers as  $mailer) {
                if (!$mailer->tag || $this->ckeckTags($mailer->tag) ) {
                    if (!$mailer->keywords || $this->checkKeywords($mailer->keyword) ) {
                        if (!$mailer->author || $mailer->author == $this->post->user->id ) {
                            if (!$mailer->cost_from || $this->checkCostFrom($mailer->cost_from, $mailer->currency) ) {
                                if (!$mailer->cost_to || $this->checkCostTo($mailer->cost_to, $mailer->currency) ) {
                                    if ($mailer->region==$this->post->region_encoded) {
                                        if (in_array($this->post->condition, $mailer->condition)) {
                                            if (in_array($this->post->type, $mailer->type)) {
                                                if (in_array($this->post->role, $mailer->role)) {
                                                    if (in_array($this->post->thread, $mailer->thread)) {
                                                        Mail::to($mailer->user->email)->send(new MailerNotification($this->post, $mailer->title)); //send mail notification to user    
                                                        break; // skip other user`s mailers if one mailer will send a message
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } 
                } 
            }
        }
    }

    private function checkCostTo($costFrom, $currency) {
        if ($currency == $this->post->currency) {
            return $costTo >= $this->post->cost;
        } else {
            if ($currency != 'USD') {
                return UsdExchangeController::uahToUsd($costTo) >= $this->post->cost;
            }
            return $costTo >= UsdExchangeController::uahToUsd($this->post->cost);
        }
    }

    private function checkCostFrom($costFrom, $currency) {
        if ($currency == $this->post->currency) {
            return $costFrom <= $this->post->cost;
        } else {
            if ($currency != 'USD') {
                return UsdExchangeController::uahToUsd($costFrom) <= $this->post->cost;
            }
            return $costFrom <= UsdExchangeController::uahToUsd($this->post->cost);
        }
    }

    private function checkKeywords($keywords) {
        foreach ( explode("\n", $keywords) as $keyword) {
            $keyword = str_replace("\r", '', $keyword);
            if ( mb_stristr($this->post->description, $keyword) ) {
                return true;
            }
        }
        return false;
    }

    private function ckeckTags($tag) {
        $tag = str_replace('.', '\.', $tag); // Escape dot in tags for regex
        $regex = "/^$tag(.[0-9]+)*$/"; // Create regex from tag
        // Check is tag of new post is comply with tag in Mailer
        if ( preg_match($regex, $this->post->tag_encoded) ) {
            return true;
        }
        return false;
    }
}
