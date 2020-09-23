<?php

namespace App\Http\Controllers\Traits;

use App\PostImage;
use App\ProfileImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
//use Spatie\ImageOptimizer\OptimizerChainFactory;
use App\Jobs\OptimizeImg;
use Illuminate\Http\UploadedFile;

// It is abstract because this controller is called only 
//   from other controllers and do not have instanse of itself
trait ImageUploader
{

    public function postImageUpload($files, $post)
    {
        $serialNo = $post->images->count() === 0 ? 1 : $post->images->where('version', 'origin')->count()+1;
        //for each submitted file
        foreach ($files as $file) {
            $name = Str::random(30);
            
            // save origin image to storage and DB;
            $path = $file->storeAs(auth()->id(), $name."_origin.".$file->extension());
            $image = new PostImage([
                'serial_no' => $serialNo,
                'path' => $path, 
                'version' => 'origin',
                'size' => $file->getSize()
            ]);
            $post->images()->save($image);
            // optimize the original image via queue;
            OptimizeImg::dispatch($path, $image->id)->onQueue('optimizeImg')->onQueue('imgOptimization');

            // resize and save image as secon version.
            $this->resizeImg($file->getPathname(), 300);
            $path = $file->storeAs(auth()->id(), $name."_optimized.".$file->extension());
            $image = new PostImage([
                'serial_no' => $serialNo,
                'path' => $path, 
                'version' => 'optimized',
                'size' => $file->getSize()
            ]);
            $post->images()->save($image);
            $serialNo++;
        }
        return true;
    }

    public function postImagesDelete($post) 
    {
        if (!$post->images->isEmpty()) {
            foreach ($post->images as $image) {
                Storage::delete($image->path); //delete from public storage
                $image->delete(); //delete alias from DB
            }
        }
    }   

    public function postImageDelete($post, $imgNo) 
    {    
        var_dump('inner delete of image');
        $images = $post->images->where('serial_no', $imgNo);
        foreach ($images as $image) {
            Storage::delete($image->path); //delete from public storage
            $image->delete(); //delete alias from DB
        }
    }

    public function userImageUpload($file)
    {
        if (is_string($file)) {
            $file = $this->fetchUrl($file);
        }
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

    private function fetchUrl($url) {
        $contents = file_get_contents($url);
        $name = substr($url, strrpos($url, '/') + 1);
        $file = '/tmp/' . $name;
        file_put_contents($file, $contents);
        $uploaded_file = new UploadedFile($file, $name);
        return $uploaded_file;
    }
}
