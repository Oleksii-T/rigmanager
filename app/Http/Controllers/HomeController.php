<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\ContactUsRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\fromUserNotification;
use Illuminate\Http\Request;

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

    public function example(Request $request)
    {
        $posts = json_decode($request->foo);
        $condition = $request->condition;
        var_dump('filtering by condition ['.$condition.']');
        $posts = collect(collect($posts)['data']);
        $filtered = $posts->filter(function($post, $key) use ($condition){
            return $post->condition == $condition;
        });
        dd($filtered);
    }

    public function faq()
    {
        return view('home.faq');
    }

    public function plans()
    {
        abort(404);
        return view('home.plans');
    }

    public function contacts()
    {
        return view('home.contacts');
    }

    public function contactUs(ContactUsRequest $request)
    {
        Mail::to(env("MAIL_TO_ADDRESS"))->send(new fromUserNotification($request->name, $request->subject, $request->text, $request->email, auth()->user()));
        Session::flash('message-success', __('messages.messageSent'));
        return redirect(route('home'));
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
