<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateAutoSchoolAdmin extends FormRequest
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
            'title' => 'required|string|min:6',
            'description' => 'required|string|min:6',
            'contacts' => 'required|array',
            'contacts.*.type' => ['required', Rule::in(['phone', 'address'])],
            'contacts.*.value' => 'required|string|min:3',
            'city_id' => 'required|integer|exists:cities,id',
            'director_id' => 'integer',
            'investor_id' => 'integer',
        ];
    }
}
