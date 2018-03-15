<?php

namespace App\Models\Location\Traits\Relationship;

use App\Models\Location\City;

/**
 * Trait PriceCityRelationship
 * @package App\Models\Location\Traits\Relationship
 */
trait PriceCityRelationship
{
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
}
