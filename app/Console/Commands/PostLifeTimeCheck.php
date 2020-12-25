<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;
use App\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostHiddenNotification;

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
            $posts = Post::where('is_active', true)->whereDate('active_to', '<', Carbon::now())->get();
            foreach ($posts as $post) {
                $post->is_active = false;
                $post->save();
                Mail::to($post->user->email)->send(new PostHiddenNotification($post));
                Log::channel('jobs')->info('[lifetime.check] Outdated post [id='.$post->id.',active_to='.$post->active_to.'] has been hidden');
            }
            Log::channel('jobs')->info('[lifetime.check] Outdated posts has been checked');
        } catch (\Throwable $th) {
            Log::channel('jobs')->info('[lifetime.check] Outdated posts checking fails');
        }
    }
}
