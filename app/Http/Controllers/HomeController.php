<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use App\Mail\fromUserNotification;
use Illuminate\Http\Request;
use App\Partner;
use App\Post;
use App\Blog;

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
        $new_posts = Post::where('is_active', 1)->orderBy('created_at', 'desc')->take(7)->get();
        
        $urgent_posts = Post::where(['is_active'=>1,'is_urgent'=>1])->orderBy('created_at', 'desc')->get();
        $urgent_posts = $urgent_posts->diff($new_posts);
        if ($urgent_posts->isNotEmpty() && $urgent_posts->count()>8) {
            $urgent_posts = $urgent_posts->random(8);
        }
        $partners = Partner::where('is_on_home', true)->take(7)->get();
        $diff = 7 - $partners->count();
        for ($i=$diff; $i > 0; $i--) {
            $partners[] = false;
        }
        return view('home.home', compact('new_posts', 'urgent_posts', 'partners'));
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
        return view('home.terms');
    }

    public function catalog()
    {
        $posts = Post::where("is_active", 1)->get()->groupBy('tag_encoded');
        $posts_amount = [];
        foreach ($posts as $tag => $p) {
            if (!is_int($tag)) {
                $t = substr($tag, 0, strpos($tag, "."));
            } else {
                $t = $tag;
            }
            if ( array_key_exists($t, $posts_amount) ) {
                $posts_amount[$t] += $p->count();
            } else {
                $posts_amount[$t] = $p->count();
            }
        }
        return view('home.catalog', compact('posts_amount'));
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

    public function blog()
    {
        $blogs = Blog::all()->paginate(env('POSTS_PER_PAGE'));
        $blogs = Blog::all()->paginate(1);
        return view('home.blog', compact('blogs'));
    }

    public function blogArticle($locale, $article)
    {
        $a = $article ? $article : $locale;
        $blog = Blog::whereSlug($a)->first();
        return view('home.blog-article', compact('blog'));
    }

    public function aboutUs()
    {
        return view('home.about_us');
    }
}
