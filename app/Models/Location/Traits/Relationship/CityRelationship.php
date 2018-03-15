<?php

namespace App\Models\Location\Traits\Relationship;

use App\Models\Location\Region;

/**
 * Trait CityRelationship
 * @package App\Models\Location\Traits\Relationship
 */
trait CityRelationship
{
    /**
     * @return mixed
     */
    public function region()
    {
        return $this->hasOne(Region::class, 'id', 'regions_id');
    }
}
