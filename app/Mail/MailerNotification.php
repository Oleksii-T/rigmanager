<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Post;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Traits\Tags;

class MailerNotification extends Mailable
{
    use Queueable, SerializesModels, Tags;

    public $post;
    public $reason;
    public $reasonValue;
    public $lang;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $post, $title)
    {
        $this->post = $post;
        $this->title = $title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__('ui.mailerNotifSubject') . ' ' . $this->title)
                    ->view('emails.mailer.notification')
                    ->text('emails.mailer.notification_plain')
                    ->withSwiftMessage(function ($message) {
                        $message->getHeaders()
                            ->addTextHeader('List-Unsubscribe', "<mailto:unsubscribe@rigmanager.com.ua?subject=Mailer");
                    });
    }
}
