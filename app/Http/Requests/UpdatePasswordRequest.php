<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Password;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()) {
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => 'password:web',
            'password' => ['required', 'string', 'min:6', 'max:20', new Password],
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'old_password.password' => __("validation.oldPass"),
            'password_confirmation.same' => __("validation.passEqual")
        ];
    }
}
