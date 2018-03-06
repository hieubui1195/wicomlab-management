<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Lang;
use MyFunctions;

class MemberRequest extends FormRequest
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
            'email' => 'required|unique:users|email',
            'name' => 'required|string',
            'level' => 'required',
        ];
    }

    public function messages()
    {
        MyFunctions::changeLanguage();

        return [
            'email.required' => Lang::get('validation.required'),
            'email.unique' => Lang::get('validation.unique'),
            'email.email' => Lang::get('validation.email'),
            'name.required' => Lang::get('validation.required'),
            'name.string' => Lang::get('validation.string'),
            'level.required' => Lang::get('validation.required'),
        ];
    }
}
