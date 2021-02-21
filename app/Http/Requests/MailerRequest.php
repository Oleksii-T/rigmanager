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
            'title' => 'required|string|max:50',
            'keyword' => 'nullable|string|min:3|max:50',
            'cost_from' => 'nullable|string|max:20',
            'cost_to' => 'nullable|string|max:20',
            'type' => 'required',
            'condition' => 'required',
            'role' => 'required',
            'thread' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => trans('validation.mailerTitleRequired'),
            'type.required' => trans('messages.mailerEmptyTypesError'),
            'condition.required' => trans('messages.mailerEmptyConditionsError'),
            'role.required' => trans('messages.mailerEmptyRolesError'),
            'thread.required' => trans('messages.mailerEmptyThreadsError'),
        ];
    }
}
