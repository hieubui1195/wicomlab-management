<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Lang;
use MyFunctions;

class EditProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'project' => 'required',
            'manager' => 'required',
            'begin' => 'required',
            'end' => 'required',
        ];
    }

    public function messages()
    {
        MyFunctions::changeLanguage();

        return [
            'project.required' => Lang::get('validation.required'),
            'manager.required' => Lang::get('validation.required'),
            'begin.required' => Lang::get('validation.required'),
            'end.required' => Lang::get('validation.required'),
        ];
    }
}
