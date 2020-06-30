<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\Phone;
use App\Rules\UserName;
use App\Rules\Password;

class UpdateUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:40', Rule::unique('users')->ignore(auth()->user()), new UserName],
            'phone' => ['nullable', 'string', 'min:8', 'max:20', new Phone],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(auth()->user())],
            'password' => ['nullable', 'string', 'min:6', 'max:20', new Password],
            'ava' => 'nullable|mimes:jpeg,jpg,jpe,png|max:5000'
        ];
    }
}
