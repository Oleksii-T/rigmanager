<?php

namespace App\Mail;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

class SubscriptionNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $type;
    public $expire;
    public $userName;
    public $lang;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($type, $expire, $userName, $lang)
    {
        $this->type = $type;
        $this->expire = $expire;
        $this->userName = $userName;
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
        return $this->subject(__('mail.subNotifSubject'))
                    ->view('emails.subscription.notification')
                    ->text('emails.subscription.notification_plain')
                    ->withSwiftMessage(function ($message) {
                        $message->getHeaders()
                            ->addTextHeader('List-Unsubscribe', "<mailto:unsubscribe@rigmanager.com.ua?subject=subscription");
                    });
    }
}
