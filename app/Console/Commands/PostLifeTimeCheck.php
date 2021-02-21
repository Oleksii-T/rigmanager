<?php

namespace App\Console\Commands;

use App\Mail\PostWasHiddenNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Post;
use App\User;

class PostLifeTimeCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lifetime:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check posts lifetimes';

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
            $posts = Post::where('is_active', true)->whereDate('active_to', '<', Carbon::now())->get()->groupBy('user_id');
            foreach ($posts as $userId => $userPosts) {
                $email = User::findOrFail($userId)->email;
                $lang = User::findOrFail($userId)->language;
                $fp = [];
                foreach ($userPosts as $p) {
                    $fp[] = [
                        'url_name' => $p->url_name,
                        'title' => $p->title
                    ];
                    $p->is_active = false;
                    $p->save();
                    Log::channel('jobs')->info('[lifetime.check] Outdated post [id='.$p->id.',active_to='.$p->active_to.'] has been hidden');
                }
                Mail::to($email)->send(new PostWasHiddenNotification($fp, $lang));
            }
            Log::channel('jobs')->info('[lifetime.check] Outdated posts has been checked sucessfully');
        } catch (\Throwable $th) {
            Log::channel('jobs')->error('[lifetime.check] Outdated posts checking fails');
        }
    }
}
