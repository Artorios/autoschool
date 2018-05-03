<?php

namespace App\Models\User\Traits\Relationship;

use App\Models\User\User;
use App\Models\Location\City;
use App\Models\Training\School\AutoSchool;
use App\Models\Training\School\AutoSchoolGroup;

trait CouponRelationship
{
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function autoSchool()
    {
        return $this->belongsTo(AutoSchool::class);
    }

    public function group()
    {
        return $this->belongsTo(AutoSchoolGroup::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class);
    }
}
