<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewRegistrationStudent extends FormRequest
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
            'name'        => 'required|string|min:3',
            'last_name'   => 'required|string|min:3',
            'second_name' => 'string|min:3',
            'email'       => 'required|email|unique:users,email',
            'phone'       => 'required',
            'password'    => 'required|string|min:6',
            'city_id' 		  => 'required|exists:cities,id',
            'license' => 'required|in:A,B,C'
        ];
    }
}
