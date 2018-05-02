<?php

namespace App\Models\User\Traits\Attribute;

use App\Models\Training\School\AutoSchoolGroup;
/**
 * Trait UserAttribute
 * @package App\Models\User\Traits\Attribute
 */
trait UserAttribute
{
    /**
     * @param string $value
     *
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getGroupNameAttribute()
    {
        return AutoSchoolGroup::select('name')->where('id',$this->attributes['auto_school_group_id'])->firstOrFail()->name;
    }

}
