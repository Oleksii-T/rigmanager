<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Rules\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Get the password reset custom validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        // If you have further fields and rules you can add in following array.
        return [
            'token' => 'required',
            'email' => ['required', 'string', 'email', 'max:254'],
            'password' => ['required', 'confirmed', 'string', 'min:6', 'max:20', new Password],
        ];
    }

    /**
     * Get the password reset validation custom error messages.
     *
     * @return array
     */
    /*
    protected function validationErrorMessages()
    {
        return [
            // Here write your custom validation error messages
        ];
    }
    */

}
