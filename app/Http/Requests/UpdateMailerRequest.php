<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMailerRequest extends FormRequest
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
        if ( auth()->user()->mailer->authors_encoded && $this->request->get('authors_encoded') ) {
            //There are Authors in mailer 100%, so NOT require keywords and tags
            return [
                'types' => 'required',
                'keywords' => 'string|nullable|min:3|max:255',
                'tags_encoded' => 'string|nullable'
            ];
        } else {
            //there are NO Authors or user deleting them right now, so make keywords and tags required
            return [
                'types' => 'required',
                'keywords' => 'required_without:tags_encoded|string|nullable|min:3|max:255',
                'tags_encoded' => 'required_without:keywords|string|nullable'
            ];
        }
    }

    public function messages()
    {
        return [
            'keywords.required_without' => trans('validation.required_without-tags'),
            'tags_encoded.required_without' => trans('validation.required_without-keywords'),
            'types.required' => trans('validation.oneFromPostTypes')
        ];
    }
}
