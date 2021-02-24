<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\MailerNotification;
use Illuminate\Console\Command;
use App\Mailer;
use App\Post;

class MailerMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailer:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail notification about posts stored in Mailers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $mailers = Mailer::all(); // Get all active Mailers
            // Iterate througth Mailers
            $mails_sent = 0;
            foreach ($mailers as $m) {
                if ($m->found_posts != []) {
                    $fp = [];
                    foreach ($m->found_posts as $id) {
                        $p = Post::findOrFail($id);
                        $fp[] = [
                            'url_name' => $p->url_name,
                            'title' => $p->title
                        ];
                    }
                    Mail::to($m->user->email)->send(new MailerNotification($fp, $m->title)); //send mail notification to user
                    $m->found_posts=null;
                    $m->save();
                    $mails_sent++;
                }
            }
            Log::channel('jobs')->info('[mailer.mail] Mailers mailed ' . $mails_sent . ' users successfully');
        } catch (\Throwable $th) {
            Log::channel('jobs')->error('[mailer.mail] Mailers mailing fails. '.$th->getMessage());
        }
    }
}
