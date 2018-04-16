<?php

namespace App\Models\Training\School;

use App\Models\Training\School\Traits\Relationship\AutoSchoolRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Autoschool
 * @package App\Models\Training\School
 */
class AutoSchool extends Model
{
    use AutoSchoolRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'city_id'
    ];
}
