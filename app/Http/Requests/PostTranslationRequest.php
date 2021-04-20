<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostTranslationRequest extends FormRequest
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
        $rules = [];
        if ($this->request->has('title_uk')) {
            $rules['title_uk'] = $titleRule;
        }
        if ($this->request->has('title_ru')) {
            $rules['title_ru'] = $titleRule;
        }
        if ($this->request->has('title_en')) {
            $rules['title_en'] = $titleRule;
        }
        if ($this->request->has('description_uk')) {
            $rules['description_uk'] = $descRule;
        }
        if ($this->request->has('description_ru')) {
            $rules['description_ru'] = $descRule;
        }
        if ($this->request->has('description_en')) {
            $rules['description_en'] = $descRule;
        }
        return $rules;
    }
}
