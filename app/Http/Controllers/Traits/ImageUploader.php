<?php

namespace App\Http\Controllers\Traits;

use App\PostImage;
use App\ProfileImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; 

// It is abstract because this controller is called only 
//   from other controllers and do not have instanse of itself
trait ImageUploader
{

    public function postImageUpload($files, $post)
    {
        foreach ($files as $file) {
            $path = $file->store(Auth::id());
            $image = new PostImage(['size' => $file->getSize(), 'path' => $path ]);
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

    public function userImageUpload($file, $user)
    {
        $path = $file->store($user->id); //save to local disk
        $image = new ProfileImage(['size' => $file->getSize(), 'path' => $path]); //create Image object
        $user->image()->save($image); //insert Image object with a ralation to user
        return true;
    }

    public function userImageDelete($user)
    {
        $image = $user->image; //get the user profile picture
        Storage::delete($image->path); //delete from local storage
        $image->delete(); //delete alias from DB
    }

    public function userImageUpdate($file)
    {
        $user = Auth::user();
        if ($user->image) {
            $this->userImageDelete($user);
        }
        $this->userImageUpload($file, $user);
    }
}
