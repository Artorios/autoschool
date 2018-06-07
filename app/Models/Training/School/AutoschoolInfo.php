<?php

namespace App\Models\Training\School;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AutoSchoolInfo
 * @package App\Models\Training\School
 */
class AutoSchoolInfo extends Model
{

    /**
     * @inheritdoc
     */
    protected $table = 'auto_school_info';

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'taxpayer_identification_number',
        'abbreviated_name_of_the_organization',
        'full_name_of_the_organization',
        'code_of_reason',
        'date_of_state_registration',
        'director',
        'auto_school_id',
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
        'contact_contact_additional_information',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function autoSchool(){
        return $this->belongsTo(AutoSchool::class);
    }
}
