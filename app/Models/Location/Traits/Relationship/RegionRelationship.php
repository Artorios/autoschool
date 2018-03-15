<?php

namespace App\Models\Location\Traits\Relationship;

use App\Models\Location\City;

/**
 * Trait RegionRelationship
 * @package App\Models\Location\Traits\Relationship
 */
trait RegionRelationship
{
    /**
     * @return mixed
     */
    public function cities()
    {
        return $this->hasMany(City::class, 'regions_id', 'id');
    }

    /**
     * @return mixed
     */
    public function citiesMain()
    {
        return $this->hasMany(City::class, 'regions_id', 'id')->where('show_city', 1);
    }
}
