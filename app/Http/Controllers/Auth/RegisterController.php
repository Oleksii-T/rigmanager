<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'email/verify';

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
            'name.unique' => __("validation.unique-username"),
            'email.unique' => __("validation.unique-email"),
            'agreement.required' => __("validation.agreement"),
        ];
        return Validator::make($data, 
        [
            'name' => ['required', 'string', 'min:3', 'max:40', 'unique:users,name'], //add regex check
            'phone' => ['string', 'nullable', 'min:8', 'max:20'], //add regex phone check
            'email' => ['required', 'string', 'email', 'max:254','unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'max:20'],
            'agreement' => ['required'],
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
        return User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'viber' => $viber,
            'telegram' => $telegram,
            'whatsapp' => $whatsapp,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
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
        sleep(5);
        //Session::flash('message-success', __('messages.signedIn'));
    }
}
