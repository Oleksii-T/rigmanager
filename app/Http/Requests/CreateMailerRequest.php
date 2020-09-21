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
            'types' => 'required',
            'keywords' => 'required_without_all:eq_tags_encoded,se_tags_encoded|string|nullable|min:3|max:255',
            'eq_tags_encoded' => 'required_without_all:keywords,se_tags_encoded|string|nullable',
            'se_tags_encoded' => 'required_without_all:keywords,eq_tags_encoded|string|nullable'
        ];
    }

    public function messages()
    {
        return [
            'keywords.required_without_all' => trans('validation.required_without-tags'),
            'eq_tags_encoded.required_without_all' => trans('validation.required_without-keywords'),
            'se_tags_encoded.required_without_all' => trans('validation.required_without-keywords'),
            'types.required' => trans('validation.oneFromPostTypes')
        ];
    }
}
