<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Custom validation the email for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    /*
    protected function validateEmail(Request $request)
    {
        $this->validate($request, 
            [
                'email' => 'required|email'
            ],
            $messages = [
                'email.required' => Translate::translate('Email_is_required.',session('locale')),
                'email.email' =>  Translate::translate('Type_valid_email.',session('locale')),
            ]);
    }
    */
}
