<?php

namespace App\Models\Training\School;

use App\Models\User\User;
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

//    protected $appends = ['student_counts'];

    /**
     * @return mixed
     */
    public function autoschool ()
    {
        return $this->hasOne(AutoSchool::class, 'id', 'auto_school_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function autoschoolgroups (){
        return $this->hasMany(AutoSchoolGroup::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function users ()
    {
        return $this->hasManyThrough(User::class, AutoSchoolGroup::class);
    }


}
