<?php

namespace App\Models\Training\School\Traits\Relationship;

use App\Models\Location\City;
use App\Models\Training\School\{
    AutoSchoolContact, AutoSchoolFilial, AutoSchoolGroup, AutoSchoolInfo
};

/**
 * Trait AutoSchoolRelationship
 * @package App\Models\Training\School\Traits\Relationship
 */
trait AutoSchoolRelationship
{
    /**
     * @return mixed
     */
    public function contacts()
    {
        return $this->hasMany(AutoSchoolContact::class, 'auto_school_id', 'id');
    }

    /**
     * @return mixed
     */
    public function phones()
    {
        return $this->hasMany(AutoSchoolContact::class, 'auto_school_id', 'id')->where('type', 'phone');
    }

    /**
     * @return mixed
     */
    public function addresses()
    {
        return $this->hasMany(AutoSchoolContact::class, 'auto_school_id', 'id')->where('type', 'address');
    }

    /**
     * @return mixed
     */
    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    /**
     * @return mixed
     */
    public function region()
    {
        return $this->city()->region();
    }

    public function filials(){
        return $this->hasMany(AutoSchoolFilial::class, 'auto_school_id', 'id');
    }

    /**
     * @return mixed
     */
    public function info()
    {
        return $this->hasOne(AutoSchoolInfo::class, 'auto_school_id', 'id');
    }

    public function autoschoolGroups()
    {
        return $this->hasMany(AutoSchoolGroup::class, 'auto_school_id', 'id');
    }
}
