<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use App\Mail\fromUserNotification;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Partner;
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
        $partners = Partner::where('is_on_home', true)->take(7)->get();
        $translated['title'] = 'title_'.App::getLocale();
        $translated['description'] = 'description_'.App::getLocale();
        $new_posts = Post::where('is_active', 1)->orderBy('created_at', 'desc')->take(7)->get();
        $top_posts = Post::where(['is_active'=>1, 'is_premium'=>1])->orderBy('created_at', 'desc')->take(4)->get();
        $top_posts = $top_posts->diff($new_posts);
        return view('home.home', compact('new_posts', 'translated', 'top_posts', 'partners'));
    }

    static public function test() {
        return 'this is from controller!';
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

    public function import()
    {
        return view('home.import_rules');
    }

    public function news()
    {
        return view('home.news');
    }

    public function aboutUs()
    {
        return view('home.about_us');
    }
}
