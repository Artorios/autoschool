<?php

namespace App\Models\User\Traits\Relationship;

use App\Models\User\User;
use App\Models\Training\School\AutoSchool;
use App\Models\Training\School\AutoSchoolGroup;

trait CouponRelationship
{
    public function autoSchool()
    {
        return $this->belongsTo(AutoSchool::class);
    }

    public function group()
    {
        return $this->belongsTo(AutoSchoolGroup::class, 'auto_school_group_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class);
    }
}
