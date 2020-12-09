<?php

namespace App\Console\Commands;

use App\Mail\PostWasHiddenNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Post;

class HideOutdated extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hide:outdated';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find and hide outdated posts.';

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
            $posts = Post::where('is_active', 1)->where('active_to', '<', Carbon::now())->get();
            foreach ($posts as $post){
                $post->is_active = false;
                $post->save();
                Mail::to($post->user->email)->send(new PostWasHiddenNotification($post)); //send mail notification to user    
            }
            Log::channel('single')->info('[custom.info][hide.outdated] Outdated posts checked successfully');
        } catch (\Throwable $th) {
            Log::channel('single')->error('[custom.error][hide.outdated] Outdated posts check fails. '.$th->getMessage());
        }
    }
}
