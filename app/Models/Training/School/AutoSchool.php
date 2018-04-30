<?php

namespace App\Models\Training\School;

use App\Models\Training\School\Traits\Relationship\AutoSchoolRelationship;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Training\School\AutoSchoolGroup;

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
        'city_id',
        'filial_name',
        'director_id',
        'investor_id'
    ];

    /**
     * @var array $appends
     */
    protected $appends = ['count_student'];

    /**
     * @return mixed
     */
    public function getCountStudentAttribute(){
        $groups    = AutoSchoolGroup::where('auto_school_id', $this->attributes['id'])->get();
        $groups_id = array_map(function ($group) {
            return $group->id;
        }, $groups);

        return User::whereIn('auto_school_group_id', $groups_id)->whereIn('role', ['user'])->count();
    }
}