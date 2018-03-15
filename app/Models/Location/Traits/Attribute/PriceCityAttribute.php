<?php

namespace App\Models\Location\Traits\Attribute;

/**
 * Trait PriceCityAttribute
 * @package App\Models\Location\Traits\Attribute
 */
trait PriceCityAttribute
{
    /**
     * @param string $value
     *
     * @return void
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }
}
