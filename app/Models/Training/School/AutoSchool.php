<?php

namespace App\Models\Training\School;

use App\Models\Training\School\Traits\Relationship\AutoSchoolRelationship;
use App\Models\Training\School\Traits\Scope\AutoSchoolScope;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Autoschool
 * @package App\Models\Training\School
 */
class AutoSchool extends Model
{
    use AutoSchoolRelationship;
    use AutoSchoolScope;

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
