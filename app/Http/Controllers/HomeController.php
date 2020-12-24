<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use App\Mail\fromUserNotification;
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
        $translated['title'] = 'title_'.App::getLocale();
        $translated['description'] = 'description_'.App::getLocale();
        $new_posts = Post::where('is_active', 1)->orderBy('created_at', 'desc')->take(7)->get();
        
        $urgent_posts = Post::where(['is_active'=>1,'is_urgent'=>1])->orderBy('created_at', 'desc')->get();
        $urgent_posts = $urgent_posts->diff($new_posts);
        if ($urgent_posts->isNotEmpty() && $urgent_posts->count()>4) {
            $urgent_posts = $urgent_posts->random(4);
        }

        return view('home.home', compact('new_posts', 'translated', 'urgent_posts'));
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
