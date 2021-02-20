<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Traits\ImageUploader;
use Laravel\Socialite\Facades\Socialite;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use Auth;

class LoginController extends Controller
{
    use ImageUploader;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    // redirect user to appropriate language stored in db
    protected function redirectTo()
    {
        if (auth()->user()->language != 'uk') {
            return route('home').'/'.auth()->user()->language;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($social)
    {
        return Socialite::driver($social)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($driver)
    {
        try {
            $social = Socialite::driver($driver)->user();
        } catch (\Throwable $th) {
            Session::flash('message-error', __('messages.serverError'));
            return redirect(loc_url(route('home')));
        }
        $socialId = $driver . '_id';
        $user = User::where($socialId, $social->id)->first();
        // check is such social ID was user before
        if ($user) {
            // such social account exist already
            Auth::loginUsingId($user->id);
        } else {
            // no social account found
            $user = User::where('email', $social->email)->first();
            // check is such email alredy user by some user
            if ( $user ) {
                // such email already exist in db
                // verify email if it was unverified
                if (!$user->email_verified_at) {
                    $user->email_verified_at = Carbon::now();
                    $user->save();
                }
                Auth::loginUsingId($user->id);
            } else {
                // it is new email and user
                $user = new User;
                $user->name = $this->fetchName($social->name);
                $user->url_name = transliteration($user->name, User::all()->pluck('url_name')->toArray());;
                $user->email = $social->email;
                $user->$socialId = $social->id;
                $user->email_verified_at = Carbon::now();
                $user->save();
                Auth::loginUsingId($user->id);
                $this->userImageUpload($social->avatar);
                $s = new SubscriptionController;
                $s->freeAccess();
            }
        }
        Session::flash('message-success', __('messages.signedIn'));
        return redirect(route('home'));
    }

    public function handleProviderCallbackTest($driver)
    {
        // Alex Puzo id: 113050782962372144121
        $social = [
            'name' => 'Ольга Тарбеева',
            'email' => 'olga.tarbeeva.66@gmail.com',
            'avatar' => 'https://lh5.googleusercontent.com/-O-Byra4GogY/AAAAAAAAAAI/AAAAAAAAAAA/AMZuuckBY9lmq5VsE5lv6YKUazxlfFGWPg/photo.jpg',
            'id' => '113804870852012522656'];
        $socialId = $driver . '_id';
        $user = User::where($socialId, $social['id'])->first();
        // check is such social ID was user before
        if ($user) {
            // such social account exist already
            Auth::loginUsingId($user->id);
        } else {
            // no social account found
            $user = User::where('email', $social['email'])->first();
            // check is such email alredy user by some user
            if ( $user ) {
                // such email already exist in db
                // verify email if it was unverified
                if (!$user->email_verified_at) {
                    $user->email_verified_at = Carbon::now();
                    $user->save();
                }
                Auth::loginUsingId($user->id);
            } else {
                // it is new email
                $user = new User;
                $user->name = $this->fetchName($social['name']);;
                $user->email = $social['email'];
                $user->$socialId = $social['id'];
                $user->email_verified_at = Carbon::now();
                $user->save();
                Auth::loginUsingId($user->id);
                $this->userImageUpload($social['avatar']);
            }
        }
        Session::flash('message-success', __('messages.signedIn'));
        return redirect(route('home'));
    }

    private function fetchName($name) {
        if ( User::where('name', $name)->first() ) {
            $fix = rand(10000, 99999);
            return $name . '_' . $fix;
        } else {
            return $name;
        }
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        Session::flash('message-success', __('messages.signedIn'));
        $redirectTo = 'test' . '/' . $user->language;
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        Session::flash('message-success', __('messages.signedOut'));
    }
}
