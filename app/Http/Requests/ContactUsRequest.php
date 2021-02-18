<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UserName;

class ContactUsRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:40', new UserName],
            'email' => 'required|email|max:254',
            'subject' => 'required|string|min:3|max:70',
            'text' => 'required|string|min:10|max:5000',
            'anti-bot-protection' => 'required'
        ];
    }
}
