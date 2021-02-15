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
        if (auth()->user()->is_social) {
            return [
                'name' => ['required', 'string', 'min:3', 'max:40', Rule::unique('users')->ignore(auth()->user()), new UserName],
                'phone_raw' => ['nullable', 'string', 'size:16', new Phone],
                'ava' => 'nullable|mimes:jpeg,jpg,jpe,png|max:5000'
            ];
        }
        return [
            'name' => ['required', 'string', 'min:3', 'max:40', Rule::unique('users')->ignore(auth()->user()), new UserName],
            'phone_raw' => ['nullable', 'string', 'size:16', new Phone],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(auth()->user())],
            'ava' => 'nullable|mimes:jpeg,jpg,jpe,png|max:5000'
        ];
    }

    public function messages()
    {
        return [
            'phone_raw.size' => trans('validation.phoneLength'),
            'name.unique' => trans('validation.unique-username'),
            'email.unique' => trans('validation.unique-email')
        ];
    }
}
