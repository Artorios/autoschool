<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserInAdmin extends FormRequest
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
            'name'        => 'string|min:3',
            'email'       => 'email',
            'role'        => Rule::in([ 'admin', 'autoschool','investor', 'user' ]),
            'last_name'   => 'string',
            'second_name' => 'string',
            'phone'       => 'string',
            'auto_school_group_id'       => 'integer|exists:auto_school_groups,id',
        ];
    }
}
