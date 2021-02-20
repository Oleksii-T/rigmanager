<?php

namespace App\Mail;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\Traits\Tags;
use Illuminate\Support\Facades\App;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Post;

class MailerNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $found_posts;
    public $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($found_posts, $title)
    {
        $this->found_posts = $found_posts;
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
