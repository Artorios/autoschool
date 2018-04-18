<?php

namespace App\Models\Training\School;

use Illuminate\Database\Eloquent\Model;

class AutoSchoolFilial extends Model
{
    protected $fillable = [
        'auto_school_id',
        'name',
        'address'
    ];

    public function autoschool()
    {
        return $this->hasOne(AutoSchool::class, 'id', 'auto_school_id');
    }


}
