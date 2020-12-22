<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailerRequest extends FormRequest
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
            'title' => 'required',
            'condition' => 'required',
            'type' => 'required',
            'role' => 'required',
            'thread' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => trans('validation.mailerTitleRequired'),
            'condition.required' => trans('messages.mailerEmptyConditionsError'),
            'type.required' => trans('messages.mailerEmptyTypesError'),
            'role.required' => trans('messages.mailerEmptyRolesError'),
            'thread.required' => trans('messages.mailerEmptyThreadsError')
        ];
    }
}
