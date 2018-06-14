<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class InvestorUserInAdmin extends FormRequest
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
            'taxpayer_identification_number' => 'string|nullable',
            'abbreviated_name_of_the_organization' => 'string|nullable',
            'full_name_of_the_organization' => 'string|nullable',
            'code_of_reason' => 'string|nullable',
            'date_of_state_registration' => 'string|nullable',
            'fio' => 'string|nullable',
            'additional_information' => 'string|nullable',
            'actual_city' => 'string|nullable',
            'actual_index' => 'string|nullable',
            'actual_address' => 'string|nullable',
            'actual_post_index' => 'string|nullable',
            'legal_city' => 'string|nullable',
            'legal_index' => 'string|nullable',
            'legal_address' => 'string|nullable',
            'bank_identification_code' => 'string|nullable',
            'bank_name' => 'string|nullable',
            'bank_correspondent_account' => 'string|nullable',
            'bank_settlement_account' => 'string|nullable',
            'contact_phone' => 'string|nullable',
            'contact_reserve_phone' => 'string|nullable',
            'contact_fax' => 'string|nullable',
            'contact_skype' => 'string|nullable',
            'contact_email' => 'string|nullable',
            'contact_additional_information' => 'string|nullable',
            'user_id' => 'integer'
        ];
    }

    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [
        ];
    }
}
