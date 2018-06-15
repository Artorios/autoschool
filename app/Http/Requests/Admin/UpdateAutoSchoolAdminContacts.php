<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAutoSchoolAdminContacts extends FormRequest
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
            'contacts' => 'nullable|array',
            'contacts.*.type' => ['nullable', Rule::in(['phone', 'address'])],
            'contacts.*.value' => 'nullable|string|min:3',

        ];
    }
}
