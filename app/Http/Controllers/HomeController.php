<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\ContactUsRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\fromUserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
        $translated['title'] = 'title_'.App::getLocale();
        $translated['description'] = 'description_'.App::getLocale();
        $posts_list = Post::where('is_active', 1)->orderBy('created_at', 'desc')->paginate(env('POSTS_PER_PAGE'));
        return view('home.home', compact('posts_list', 'translated'));
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

    public function contactUs(ContactUsRequest $request)
    {
        Mail::to(env("MAIL_TO_ADDRESS"))->send(new fromUserNotification($request->name, $request->subject, $request->text, $request->email, auth()->user()));
        Session::flash('message-success', __('messages.messageSent'));
        return redirect(route('home'));
    }

    public function terms()
    {
        $locale = App::getLocale();
        $view = 'home.terms.'.$locale;
        return view($view);
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
