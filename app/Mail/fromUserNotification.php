<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class fromUserNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $userSubject;
    public $text;
    public $email;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $subject, $text, $userEmail, $user)
    {
        $this->name = $name;
        $this->userSubject = $subject;
        $this->text = $text;
        $this->email = $userEmail;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("User Feedback")
                    ->view('emails.fromUser');
    }
}
