<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Post;

class MailerNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $post;
    public $reason;
    public $reasonValue;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $post, $reason, $reasonValue)
    {
        $this->post = $post;
        $this->reason = $reason;
        $this->reasonValue = $reasonValue;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.mailer.notification')
                    ->text('emails.mailer.notification_plain');
    }
}
