<?php

namespace App\Jobs;

use App\Http\Controllers\UsdExchangeController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
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
                    if (!$mailer->keyword || $this->checkKeywords($mailer->keyword) ) {
                        if (!$mailer->author || $mailer->author == $this->post->user->id ) {
                            if (!$mailer->cost_from || $this->checkCostFrom($mailer->cost_from, $mailer->currency) ) {
                                if (!$mailer->cost_to || $this->checkCostTo($mailer->cost_to, $mailer->currency) ) {
                                    if (!$mailer->region || $mailer->region==$this->post->region_encoded) {
                                        if (!$this->post->condition || in_array($this->post->condition, $mailer->condition)) {
                                            if (in_array($this->post->type, $mailer->type)) {
                                                if (in_array($this->post->role, $mailer->role)) {
                                                    if (in_array($this->post->thread, $mailer->thread)) {
                                                        // save the post founded list of mailer
                                                        $fp = $mailer->found_posts;
                                                        $fp[] = $this->post->id;
                                                        $mailer->found_posts = $fp;
                                                        $mailer->save();
                                                        break; // skip other user`s mailers if one mailer will send a message
                                                    } //else {var_dump('Bad thread');}
                                                } //else {var_dump('Bad role');}
                                            } //else {var_dump('Bad type');}
                                        }  //else {var_dump('Bad condition');}
                                    } //else {var_dump('Bad region');}
                                } //else {var_dump('Bad cost to');}
                            } //else {var_dump('Bad corst from');}
                        } //else {var_dump('Bad author');}
                    } //else {var_dump('Bad keyword');}
                } //else {var_dump('Bad tag');}
            }
        }
    }

    private function checkCostTo($costTo, $currency) {
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
        if (!$keywords) {
            return false;
        }
        foreach ( explode("\n", $keywords) as $keyword) {
            $keyword = str_replace("\r", '', $keyword);
            if (   mb_stristr($this->post->description, $keyword) 
                || mb_stristr($this->post->description_uk, $keyword) 
                || mb_stristr($this->post->description_ru, $keyword) 
                || mb_stristr($this->post->description_en, $keyword) 
                || mb_stristr($this->post->title, $keyword) 
                || mb_stristr($this->post->title_uk, $keyword) 
                || mb_stristr($this->post->title_ru, $keyword) 
                || mb_stristr($this->post->title_en, $keyword) 
                || mb_stristr($this->post->manufacturer, $keyword) 
                || mb_stristr($this->post->company, $keyword) 
                || mb_stristr($this->post->part_number, $keyword) ) 
            {
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
