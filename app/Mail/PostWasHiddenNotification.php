<?php

namespace App\Mail;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Post;

class PostWasHiddenNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $found_posts;
    public $lang;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fp, $lang)
    {
        $this->found_posts = $fp;
        $this->lang = $lang;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        App::setLocale($this->lang);
        return $this->subject(__('ui.postHiddenNotifSubject'))
                    ->view('emails.postHidden.notification')
                    ->text('emails.postHidden.notification_plain')
                    ->withSwiftMessage(function ($message) {
                        $message->getHeaders()
                            ->addTextHeader('List-Unsubscribe', "<mailto:unsubscribe@rigmanager.com.ua?subject=PostWasHidden");
                    });
    }
}
