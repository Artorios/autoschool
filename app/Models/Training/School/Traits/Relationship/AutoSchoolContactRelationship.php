<?php

namespace App\Models\Training\School\Traits\Relationship;

use App\Models\Training\School\AutoSchool;

/**
 * Trait AutoSchoolContactRelationship
 * @package App\Models\Training\School\Traits\Relationship
 */
trait AutoSchoolContactRelationship
{
    /**
     * @return mixed
     */
    public function autoSchools()
    {
        return $this->belongsTo(AutoSchool::class);
    }
}
