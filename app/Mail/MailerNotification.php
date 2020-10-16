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
    public function __construct(Post $post, $reason, $reasonValue, $lang)
    {
        $this->post = $post;
        $this->reason = $reason;
        $this->reasonValue = $reasonValue;
        $this->lang = $lang;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->translate();
        return $this->subject(__('ui.mailerNotifSubject'))
                    ->view('emails.mailer.notification')
                    ->text('emails.mailer.notification_plain')
                    ->withSwiftMessage(function ($message) {
                        $message->getHeaders()
                            ->addTextHeader('List-Unsubscribe', "<mailto:unsubscribe.mailer@rigmanager.com.ua?subject=Unsubscibe");
                    });
    }

    private function translate() {
        App::setLocale($this->lang);
        switch ($this->reason) {
            case 'tags':
                $this->reason = __('ui.mailerNotifTags');
                $this->reasonValue = $this->getTagReadable($this->reasonValue);
                break;
            case 'author':
                $this->reason = __('ui.mailerNotifAuthors');
                break;
            case 'keywords':
                $this->reason =  __('mailerNotifDescription');
                break;
        }
    }
}
