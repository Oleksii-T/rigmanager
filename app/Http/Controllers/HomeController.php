<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

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
        $posts_list = Post::orderBy('created_at', 'desc')->paginate(env('POSTS_PER_PAGE'));
        return view('home', compact('posts_list'));
    }

    public function about()
    {
        return view('about');
    }
}
