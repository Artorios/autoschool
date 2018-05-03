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
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function autoSchool(){
        return $this->belongsTo(AutoSchool::class);
    }
}
