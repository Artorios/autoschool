<?php

namespace App\Models\Location;

use App\Models\Location\Traits\Relationship\RegionRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Region
 * @package App\Models\Location
 */
class Region extends Model
{
    use RegionRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
