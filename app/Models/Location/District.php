<?php

namespace App\Models\Location;

use App\Models\Location\Traits\Relationship\DistrictRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * Class District
 * @package App\Models\Location
 */
class District extends Model
{
    use DistrictRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'cities_id'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
