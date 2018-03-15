<?php

namespace App\Models\Location;

use App\Models\Location\Traits\Attribute\PriceCityAttribute;
use App\Models\Location\Traits\Relationship\PriceCityRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PriceCity
 * @package App\Models\Location
 */
class PriceCity extends Model
{
    use PriceCityRelationship, PriceCityAttribute;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'price',
        'slug',
        'show_city',
        'city_id'
    ];
}
