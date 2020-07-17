<?php

namespace App\Http\Controllers\Traits;

use App\PostImage;
use App\ProfileImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Spatie\ImageOptimizer\OptimizerChainFactory;

// It is abstract because this controller is called only 
//   from other controllers and do not have instanse of itself
trait ImageUploader
{

    public function postImageUpload($files, $post)
    {
        //for each submitted file
        foreach ($files as $file) {
            $name = Str::random(30);
            //optimize image
            $optimizerChain = OptimizerChainFactory::create();
            $optimizerChain->setTimeout(5)->optimize($file->getPathname());
            //save original image. Firstly to server then to DB
            $path = $file->storeAs(auth()->id(), $name."_origin.".$file->extension());
            $image = new PostImage([
                'size' => $file->getSize(), 
                'path' => $path, 
                'version' => 'origin'
            ]);
            $post->images()->save($image);
            
            //save resized to 300 max side image. Firstly to server then to DB
            $this->resizeImg($file->getPathname(), 300);
            $path = $file->storeAs(auth()->id(), $name."_optimized.".$file->extension());
            $image = new PostImage([
                'size' => $file->getSize(), 
                'path' => $path, 
                'version' => 'optimized'
            ]);
            $post->images()->save($image); //insert Image object with a ralation to post
        }
        return true;
    }

    public function postImagesDelete($post) {
        if (!$post->images->isEmpty()) {
            foreach ($post->images as $image) {
                Storage::delete($image->path); //delete from public storage
                $image->delete(); //delete alias from DB
            }
        }
    }   

    public function userImageUpload($file)
    {
        $user = auth()->user();
        $this->resizeImg($file->getPathname(), 300);
        $path = $file->store($user->id); //save to local disk
        $image = new ProfileImage(['size' => $file->getSize(), 'path' => $path]); //create Image object
        $user->image()->save($image); //insert Image object with a ralation to user
        return true;
    }

    public function userImageDelete()
    {
        $image = auth()->user()->image; //get the user profile picture
        if ($image) {
            Storage::delete($image->path); //delete from local storage
            $image->delete(); //delete alias from DB
        }
    }

    public function userImageUpdate($file)
    {
        $user = auth()->user();
        if ($user->image) {
            $this->userImageDelete($user);
        }
        $this->userImageUpload($file, $user);
    }

    private function resizeImg ($path, $maxLength) {
        $intervention = Image::make($path);
        //check is image big enougth to be resized
        if ($intervention->width() > $maxLength || $intervention->height() > $maxLength) {
            if ($intervention->width() > $intervention->height()) {
                //resize by width
                $intervention->resize($maxLength, null, function($constraint) { $constraint->aspectRatio(); });
            } else {
                //resize by height
                $intervention->resize(null, $maxLength, function($constraint) { $constraint->aspectRatio(); });
            }
            //save resized img to tmp path of image
            $intervention->save($path);
        }
    }
}
