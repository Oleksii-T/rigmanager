<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Rules\Phone;
use App\Rules\UserName;
use App\Rules\Password;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', "min:3", 'max:40', 'unique:users,name', new UserName],
            'phone' => ['nullable', 'string', 'min:8', 'max:20', new Phone],
            'email' => 'required|email|max:255|unique:users,email',
            'password' => ['required', 'string', 'min:6', 'max:20', new Password],
            'ava' => 'nullable|mimes:jpeg,jpg,jpe,png|max:5000'
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => trans('validation.unique-username'),
            'email.unique' => trans('validation.unique-email')
        ];
    }
}
