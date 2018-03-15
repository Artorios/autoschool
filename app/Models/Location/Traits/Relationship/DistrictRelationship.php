<?php

namespace App\Models\Location\Traits\Relationship;

use App\Models\Location\City;

/**
 * Trait DistrictRelationship
 * @package App\Models\Location\Traits\Relationship
 */
trait DistrictRelationship
{
    /**
     * @return mixed
     */
    public function city()
    {
        return $this->hasOne(City::class, 'id', 'cities_id');
    }
}
