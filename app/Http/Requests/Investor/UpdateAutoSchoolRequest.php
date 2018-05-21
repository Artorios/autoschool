<?php

namespace App\Http\Requests\Investor;

use App\Http\Requests\BaseRequest;

class UpdateAutoSchoolRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('investor-autoschool', $this->route('autoschool'));
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
            'city_id' => 'required|integer|exists:cities,id',
            'contacts' => 'required|array',
            'contacts.*.type' => 'required|in:phone,address',
            'contacts.*.value' => 'required|string|min:3',
        ];
    }
}
