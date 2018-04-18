<?php

namespace App\Models\Training\School;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AutoSchoolFilial
 * @package App\Models\Training\School
 */
class AutoSchoolFilial extends Model
{

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'auto_school_id',
        'name',
        'address'
    ];

    /**
     * @return mixed
     */
    public function autoschool()
    {
        return $this->hasOne(AutoSchool::class, 'id', 'auto_school_id');
    }


}
