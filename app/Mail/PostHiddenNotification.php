<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Post;
use Illuminate\Support\Facades\App;

class PostHiddenNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $post;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        App::setLocale($this->post->user->language);
        return $this->subject(__('ui.postHiddenNotifSubject'))
                    ->view('emails.postHidden.notification')
                    ->text('emails.postHidden.notification_plain')
                    ->withSwiftMessage(function ($message) {
                        $message->getHeaders()
                            ->addTextHeader('List-Unsubscribe', "<mailto:unsubscribe@rigmanager.com.ua?subject=Post hidden");
                    });
    }
}
