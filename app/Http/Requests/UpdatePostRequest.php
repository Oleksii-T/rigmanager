<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Phone;

class UpdatePostRequest extends FormRequest
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
        $titleRule = 'required|string|min:10|max:70';
        $descRule = 'required|string|min:10|max:9000';
        $rules = [
            'title' => $titleRule,
            'company' => 'nullable|string|min:5|max:200',
            'description' => $descRule,
            'cost' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:100',
            'user_email' => 'nullable|required_without:user_phone|email|max:255',
            'user_phone_raw' => ['nullable', 'required_without:user_email', 'string', 'size:16', new Phone],
            'images.*' => 'nullable|image|mimes:jpeg,jpg,jpe,png|max:5000',
        ];
        if ( !array_key_exists('uk', $this->request->get('title_translate')) ) {
            $rules['title_uk'] = $titleRule;
        }
        if ( !array_key_exists('ru', $this->request->get('title_translate')) ) {
            $rules['title_ru'] = $titleRule;
        }
        if ( !array_key_exists('en', $this->request->get('title_translate')) ) {
            $rules['title_en'] = $titleRule;
        }
        if ( !array_key_exists('uk', $this->request->get('desc_translate')) ) {
            $rules['description_uk'] = $descRule;
        }
        if ( !array_key_exists('ru', $this->request->get('desc_translate')) ) {
            $rules['description_ru'] = $descRule;
        }
        if ( !array_key_exists('en', $this->request->get('desc_translate')) ) {
            $rules['description_en'] = $descRule;
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'user_email.required_without' => trans('validation.required_without-phone'),
            'user_phone_raw.size' => trans('validation.phoneLength'),
            'user_phone_raw.required_without' => trans('validation.required_without-email')
        ];
    }
}
