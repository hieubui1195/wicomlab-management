<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Lang;
use MyFunctions;

class ProfileRequest extends FormRequest
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
            'name' => 'required|string',
            'phone' => 'nullable|numeric',
            'image' => 'image|mimes:jpg,jpeg,bmp,png|max:2000',
        ];
    }

    public function messages()
    {
        MyFunctions::changeLanguage();

        return [
            'name.required' => Lang::get('validation.required'),
            'name.string' => Lang::get('validation.string'),
            'phone.numeric' => Lang::get('validation.numeric'),
            'phone.regex' => Lang::get('validation.regex'),
            'phone.between' => Lang::get('validation.between.numeric'),
            'image.image' => Lang::get('validation.image'),
            'image.mimes' => Lang::get('validation.image', ['values' => 'jpg,jpeg,bmp,png']),
            'image.max' => Lang::get('validation.max.file'),

        ];
    }
}
