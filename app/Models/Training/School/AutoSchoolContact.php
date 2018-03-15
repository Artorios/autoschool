<?php

namespace App\Models\Training\School;

use App\Models\Training\School\Traits\Attribute\AutoSchoolContactAttribute;
use App\Models\Training\School\Traits\Relationship\AutoSchoolContactRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AutoSchoolContact
 * @package App\Models\Training\School
 */
class AutoSchoolContact extends Model
{
    use AutoSchoolContactRelationship, AutoSchoolContactAttribute;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'value',
        'auto_school_id'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['type_name'];
}
