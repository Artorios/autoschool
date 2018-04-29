<?php

namespace App\Http\Requests\Investor;

use Rule;
use App\Http\Requests\BaseRequest;

class UpdateProfileRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'requisite_type' => [
                'required',
                Rule::in([
                    'legal_entity',
                    'individual',
                    'legal_address',
                    'bank_details',
                    'contacts',
                ]),
            ],
        ];
    }
}
