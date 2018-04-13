<?php

namespace App\Models\Location;

use App\Models\Location\Traits\Relationship\CityRelationship;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


/**
 * Class City
 * @package App\Models\Location
 */
class City extends Model
{
    use CityRelationship;
    use Searchable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'regions_id', 'ru_path', 'price', 'show_city'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
