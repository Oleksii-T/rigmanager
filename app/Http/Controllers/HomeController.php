<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Session::forget('search');
        Session::forget('oldSearch');
        Session::forget('searchAuthor');
        $posts_list = Post::orderBy('created_at', 'desc')->paginate(env('POSTS_PER_PAGE'));
        $tagsArray = "";
        return view('home', compact('posts_list', 'tagsArray'));
    }
    
    public function about()
    {
        return view('about');
    }
}
