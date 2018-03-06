<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Lang;
use MyFunctions;

class NewTaskRequest extends FormRequest
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
        $rules = [
            'task' => 'required|unique:tasks',
            'begin' => 'required',
            'end' => 'required',
            'description' => 'required',
            'performers' => 'required|min:1',
        ];

        // $performers = count($this->input('performers'));
        // foreach(range(0, $performers) as $index) {
        //     $rules['performers.' . $index] = 'required|min:1';
        // }

        return $rules;
    }

    public function messages()
    {
        MyFunctions::changeLanguage();

        return [
            'task.required' => Lang::get('validation.required'),
            'task.unique' => Lang::get('validation.unique'),
            'begin.required' => Lang::get('validation.required'),
            'end.required' => Lang::get('validation.required'),
            'description.required' => Lang::get('validation.required'),
            'performers.required' => Lang::get('validation.required'),
            'performers.min' => Lang::get('validation.min.numeric'),
        ];
    }
}
