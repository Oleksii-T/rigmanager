<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Post;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function userAccess()
    {
        return view('admin.user-access');
    }
    
    public function loginAs(Request $reqest)
    {
        auth()->loginUsingId($reqest->user);
        return redirect(loc_url(route('home')));
    }
    
    public function mailers()
    {
        return view('admin.mailers');
    }
    
    public function graphs()
    {
        return view('admin.graphs');
    }
    
    public function unverifiedPosts()
    {
        $p = Post::where('is_verified', false)->inRandomOrder()->limit(1)->get();
        if ($p->isEmpty()) {
            Session::flash('message-success', 'All posts are verified!');
            return redirect(route('admin.panel'));
        } else {
            $p = $p[0];
        }
        $t = Post::where('is_verified', false)->count();
        return view('admin.up', compact('p', 't'));
    }

    public function unverifiedPostsHistory()
    {
        $posts = Post::where('is_verified', true)->orderBy('verified_at', 'DESC')->get();
        return view('admin.uph', compact('posts'));
    }

    public function verifyPost($post)
    {
        $p = Post::find($post);
        if (!$p) {
            Session::flash('message-error', 'Post was not found');
        } else {
            $p->is_verified = true;
            $p->verified_at = Carbon::now();
            $p->save();
            Session::flash('message-success', 'Post has been verified!');
        }
        return redirect(route('admin.up'));
    }

    public function editPost($post, $user) 
    {
        auth()->loginUsingId($user);
        $post = Post::find($post);
        return redirect(route('posts.edit', ['post'=>$post->url_name]));
    }
}
