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


    protected $appends = ['count_student'];


    public function getCountStudentAttribute(){
        $groups = AutoSchoolGroup::where('auto_school_id', $this->attributes['id'])->get();//->whereNotIn('role',['admin','investor','autoschool'])->count();
        $groups_id = [];
        foreach ($groups as $group){
            array_push($groups_id, $group->id);
        }
        $counts = User::whereIn('auto_school_group_id',$groups_id)->whereNotIn('role', ['admin','investor','autoschool'])->count();
        return $counts;
    }
}