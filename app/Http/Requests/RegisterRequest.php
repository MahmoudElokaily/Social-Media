<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'email' => 'required|max:100',
            'password' => 'required|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'This field is required',
            'email.required' => 'This field is required',
            'password.required' => 'This field is required',
        ];
    }
}
