<?php

namespace App\Models\Training\School;

use App\Models\Training\School\Traits\Relationship\AutoSchoolRelationship;
use App\Models\User\User;
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
        'city_id',
        'filial_name',
        'director_id',
        'investor_id',
        'logo'
    ];

    /**
     * @var array $appends
     */
    protected $appends = ['count_student'];

    /**
     * @return mixed
     */
    public function getCountStudentAttribute(){
        $groups    = AutoSchoolGroup::select('id')->where('auto_school_id', $this->attributes['id'])->get()->toArray();
        $groups_id = array_map(function ($group) {
            return $group['id'];
        }, $groups);
        return User::whereIn('auto_school_group_id', $groups_id)->whereIn('role', ['user'])->count();
    }
}