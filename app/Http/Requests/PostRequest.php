<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UnlimitedLifetime;
use App\Rules\Phone;

class PostRequest extends FormRequest
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
        $rules = [
            'title' => 'required|string|min:10|max:70',
            'amount' => 'nullable|string|max:15',
            'company' => 'nullable|string|min:5|max:200',
            'manufacturer' => 'nullable|string|min:3|max:70',
            'manufactured_date' => 'nullable|string|min:3|max:70',
            'part_number' => 'nullable|string|min:3|max:70',
            'description' => 'required|string|min:10|max:9000',
            'cost' => 'nullable|string|max:20',
            'town' => 'nullable|string|max:100',
            'user_email' => 'nullable|required_without:user_phone_raw|email|max:255',
            'user_phone_raw' => ['nullable', 'required_without:user_email', 'string', 'size:16', new Phone],
            'lifetime' => [new UnlimitedLifetime],
            'images.*' => 'nullable|image|mimes:jpeg,jpg,jpe,png|max:5000',
            'images' => 'max:5',
            'doc' => 'nullable|mimes:pdf|max:10000',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'user_email.required_without' => trans('validation.required_without-phone'),
            'user_phone_raw.size' => trans('validation.phoneLength'),
            'user_phone_raw.required_without' => trans('validation.required_without-email'),
            'images.max' => trans('validation.maxfiles', ['max'=>5])
        ];
    }
}
