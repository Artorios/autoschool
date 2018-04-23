<?php

namespace App\Models\Training\School;

use Illuminate\Database\Eloquent\Model;

class AutoSchoolInfo extends Model
{

    protected $fillable = [
        'taxpayerIdentificationNumber',
        'abbreviatedNameOfTheOrganization',
        'fullNameOfTheOrganization',
        'codeOfReason',
        'dateOfStateRegistration',
        'director',
    ];

    public function autoSchool(){
        return $this->belongsTo(AutoSchool::class);
    }
}
