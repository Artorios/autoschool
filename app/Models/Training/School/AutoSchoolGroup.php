<?php

namespace App\Models\Training\School;

use Illuminate\Database\Eloquent\Model;

class AutoSchoolGroup extends Model
{
    public function autoschool(){
        return $this->hasOne(AutoSchool::class, 'id', 'auto_school_id');
    }
}
