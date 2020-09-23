<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Carbon\Carbon;
use Auth;
use App\Http\Controllers\Traits\ImageUploader;

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
    /*
    public function handleProviderCallback($social)
    {
        // Alex Puzo id: 113050782962372144121
        $arr = [
            'name' => 'Ольга Тарбеева',
            'email' => 'olga.tarbeeva.66@gmail.com',
            'avatar' => 'https://lh5.googleusercontent.com/-O-Byra4GogY/AAAAAAAAAAI/AAAAAAAAAAA/AMZuuckBY9lmq5VsE5lv6YKUazxlfFGWPg/photo.jpg',
            'id' => '113804870852012522656'];
        $socialId = $social . '_id';
        $user = User::where($socialId, $arr['id'])->first();
        // check is such social ID was user before
        if ($user) {
            // such social account exist already
            Auth::loginUsingId($user->id);
        } else {
            // no social account found
            $user = User::where('email', $arr['email'])->first();
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
                $user->name = $this->fetchName($arr['name']);;
                $user->email = $arr['email'];
                $user->$socialId = $arr['id'];
                $user->email_verified_at = Carbon::now();
                $user->save();
                Auth::loginUsingId($user->id);
                $this->userImageUpload($arr['avatar']);
            }
        }
        Session::flash('message-success', __('messages.signedIn'));
        return redirect(route('home'));
    }
    */
    public function handleProviderCallback($social)
    {
        $user = Socialite::driver($social)->user();
        $socialId = $social . '_id';
        $user = User::where($socialId, $user->id)->first();
        // check is such social ID was user before
        if ($user) {
            // such social account exist already
            Auth::loginUsingId($user->id);
        } else {
            // no social account found
            $user = User::where('email', $user->email)->first();
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
                $user->name = $this->fetchName($user->name);;
                $user->email = $user->email;
                $user->$socialId = $user->id;
                $user->email_verified_at = Carbon::now();
                $user->save();
                Auth::loginUsingId($user->id);
                $this->userImageUpload($user->avatar);
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
