<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class InvestorInfo extends Model
{
    /**
     * @inheritdoc
     */
    protected $table = 'investor_info';

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'user_id',
        'taxpayer_identification_number',
        'abbreviated_name_of_the_organization',
        'full_name_of_the_organization',
        'code_of_reason',
        'date_of_state_registration',
        'fio',
        'additional_information',
        'actual_city',
        'actual_index',
        'actual_address',
        'actual_post_index',
        'legal_city',
        'legal_index',
        'legal_address',
        'bank_identification_code',
        'bank_name',
        'bank_correspondent_account',
        'bank_settlement_account',
        'contact_phone',
        'contact_reserve_phone',
        'contact_fax',
        'contact_skype',
        'contact_email',
        'contact_additional_information',
    ];
}
