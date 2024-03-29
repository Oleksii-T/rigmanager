<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Traits\ImageUploader;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Rules\UserName;
use App\Rules\Password;
use App\Rules\Phone;
use App\User;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, ImageUploader;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'email/verify';

    // redirect user to appropriate language stored in db
    protected function redirectTo()
    {
        if (auth()->user()->language != 'uk') {
            return loc_url(route('verification.notice'));
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        $messages = [
            'phone_raw.size' => trans('validation.phoneLength'),
            'name.unique' => __("validation.unique-username"),
            'email.unique' => __("validation.unique-email"),
            'agreement.required' => __("validation.agreement"),
            'password_confirmation.same' => __("validation.passEqual"),
        ];
        return Validator::make($data,
        [
            'name' => ['required', 'string', 'min:3', 'max:40', 'unique:users,name', new UserName],
            'phone_raw' => ['string', 'nullable', 'size:16', new Phone],
            'email' => 'required|string|email|max:254|unique:users,email',
            'password' => ['required', 'string', 'min:6', 'max:20', new Password],
            'password_confirmation' => 'required|same:password',
            'agreement' => 'required',
            'ava' => 'nullable|mimes:jpeg,jpg,jpe,png|max:5000',
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $viber = array_key_exists('viber', $data) ? 1 : 0;
        $telegram = array_key_exists('telegram', $data) ? 1 : 0;
        $whatsapp = array_key_exists('whatsapp', $data) ? 1 : 0;
        $phone = array_key_exists('whatsapp', $data) ? $data['phone'] : null;
        $url = transliteration($data['name'], User::all()->pluck('url_name')->toArray());
        $user = User::create([
            'url_name' => $url,
            'name' => $data['name'],
            'phone' => $phone,
            'viber' => $viber,
            'telegram' => $telegram,
            'whatsapp' => $whatsapp,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        if ( array_key_exists('ava', $data) ) {
            $this->userImageUpload($data['ava'], $user);
        }
        return $user;
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {

    }
}
