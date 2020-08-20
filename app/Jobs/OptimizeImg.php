<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use App\PostImage;

class OptimizeImg implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 2;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 30;
    
    protected $path;
    protected $imgId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($path, $imgId)
    {
        $this->path = $path;
        $this->imgId = $imgId;
    }

    /**
     * Execute the job. Optimize image and update 'size' value in DB 
     *
     * @return void
     */
    public function handle()
    {
        $fullpath = 'storage/' . $this->path;
        $fullpath = public_path() . '/' . $fullpath; // make absolute path for queue job
        // optimize original image
        $optimizerChain = OptimizerChainFactory::create();
        $optimizerChain->optimize($fullpath);
        // change 'size' record in DB;
        $postImage = PostImage::findOrFail($this->imgId);
        $postImage->size = filesize($fullpath); // KB
        $postImage->save();
    }
}
