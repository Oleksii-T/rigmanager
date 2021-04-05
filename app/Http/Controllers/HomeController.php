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
        //{"uk":"Автор!","ru":"Автор","en":"Author"}
        $t = [
            'uk' => 'Мі відкрились!',
            'ru' => 'Мы открылись!',
            'en' => 'We have opened!'
        ];
        //{"uk":"Мі відкрились!","ru":"Мы открылись!","en":"We have opened!"}
        $i = [
            'uk' => 'Минуло досить багато часу поки наш вебсайт заробив в такому вигляді в якому ви його бачите зараз. Не дивлячись на це, у нашій команді ще величезна кількість ідей і планів з розвитку сервісу. Ми сподіваємося, що наша платформа допоможе у виконанні ваших завдань і ми зможемо перевести співпрацю нафтогазових компаній на новий рівень.',
            'ru' => 'Прошло довольно много времени пока наш вебсайт заработал в таком виде в каком вы его видите сейчас. Не смотря на это, у нашей команде еще огромное количество идей и планов по развитию сервиса. Мы надеемся, что наша платформа поможет в выполнении ваших задач и мы сможем перевести сотрудничество нефтегазовых компаний на новый уровень.',
            'en' => 'It took quite a long time for our website to work as you see it now. Despite this, our team still has a huge number of ideas and plans for the development of the service. We hope that our platform will help you to fulfill your tasks and we will be able to take the cooperation of oil and gas companies to a new level.'
        ];
        //{"uk":"Минуло досить багато часу поки наш вебсайт заробив в такому вигляді в якому ви його бачите зараз. Не дивлячись на це, у нашій команді ще величезна кількість ідей і планів з розвитку сервісу. Ми сподіваємося, що наша платформа допоможе у виконанні ваших завдань і ми зможемо перевести співпрацю нафтогазових компаній на новий рівень.","ru":"Прошло довольно много времени пока наш вебсайт заработал в таком виде в каком вы его видите сейчас. Не смотря на это, у нашей команде еще огромное количество идей и планов по развитию сервиса. Мы надеемся, что наша платформа поможет в выполнении ваших задач и мы сможем перевести сотрудничество нефтегазовых компаний на новый уровень.","en":"It took quite a long time for our website to work as you see it now. Despite this, our team still has a huge number of ideas and plans for the development of the service. We hope that our platform will help you to fulfill your tasks and we will be able to take the cooperation of oil and gas companies to a new level."}
        $b = [
            'uk' => 'Ми ведемо активну рекламну компанію по пошуку партнерів і збільшення кількості оголошень. Ми будемо раді будь-якому відкликанню і пропозицією!',
            'ru' => 'Мы ведем активную рекламную компании по поиску партнеров и увеличению количества объявлений. Мы будем рады любому отзыву и предложению!',
            'en' => 'We run an active advertising campaign to find partners and increase the number of ads. We will be glad to any feedback and suggestions!'
        ];
        //{"uk":"Ми ведемо активну рекламну компанію по пошуку партнерів і збільшення кількості оголошень. Ми будемо раді будь-якому відкликанню і пропозицією!","ru":"Мы ведем активную рекламную компании по поиску партнеров и увеличению количества объявлений. Мы будем рады любому отзыву и предложению!","en":"We run an active advertising campaign to find partners and increase the number of ads. We will be glad to any feedback and suggestions!"}
        $o = [
            'uk' => '',
            'ru' => '',
            'en' => ''
        ];
        $blogs = Blog::all();
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
