<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Post;
use App\Blog;

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
    
    public function unverifiedPosts(Request $request)
    {
        if ($request->has('skip')) {
            $p = Post::where('is_verified', false)->oldest()->skip($request->get('skip'))->take(1)->get();
        } else {
            $p = Post::where('is_verified', false)->oldest()->take(1)->get();
        }
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

    public function verifyPost(Request $request, $post)
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
        if ($request->has('skip')) {
            return redirect( route('admin.up').'?skip='.$request->get('skip') );
        }
        return redirect(route('admin.up'));
    }

    public function editPostRow(Request $request, $post)
    {
        $p = Post::find($post);
        if (!$p) {
            Session::flash('message-error', 'Post was not found');
        } else {
            $row = $request->get('row');
            $p->$row = $request->get('value');
            $p->save();
            Session::flash('message-success', 'Post ['.$request->get('row').'] was changed successfully');
        }
        if ($request->has('skip') && $request->get('skip')!='0') {
            return redirect( route('admin.up').'?skip='.$request->get('skip') );
        }
        return redirect(route('admin.up'));
    }

    public function editPost($post, $user) 
    {
        auth()->loginUsingId($user);
        $post = Post::find($post);
        return redirect(route('posts.edit', ['post'=>$post->url_name]));
    }

    public function blogCreate() {
        return view('admin.blog-create');
    }

    public function blogStore(Request $request) {
        $input = $request->all();
        $blog = new Blog($input);
        $blog->save();
        if ($request->has('created_at')) {
            $blog->created_at = $request->created_at;
            $blog->save();
        }
        return redirect(route('admin.panel'));
    }
}
