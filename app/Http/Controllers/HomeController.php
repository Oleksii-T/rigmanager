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
        $posts_list = Post::orderBy('created_at', 'desc')->paginate(env('POSTS_PER_PAGE'));
        return view('home.home', compact('posts_list'));
    }
    
    public function faq()
    {
        return view('home.faq');
    }
    public function plans()
    {
        return view('home.plans');
    }
    public function contacts()
    {
        return view('home.contacts');
    }
    public function terms()
    {
        return view('home.terms');
    }
    public function privacy()
    {
        return view('home.privacy');
    }
    public function sitemap()
    {
        return view('home.sitemap');
    }
}
