<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMailerRequest extends FormRequest
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
            'keywords' => 'required_without:tags_encoded|string|nullable|max:255',
            'tags_encoded' => 'required_without:keywords|string|nullable'
        ];
    }

    public function messages()
    {
        return [
            'keywords.required_without' => trans('validation.required_without-tags'),
            'tags_encoded.required_without' => trans('validation.required_without-keywords')
        ];
    }
}
