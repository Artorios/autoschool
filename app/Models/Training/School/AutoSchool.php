<?php

namespace App\Models\Training\School;

use App\Models\Training\School\Traits\Relationship\AutoSchoolRelationship;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Training\School\AutoSchoolGroup;
use App\Models\Location\City;
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
    protected $appends = ['count_student', 'city_name'];

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
    public function getCityNameAttribute(){
        if(!empty($this->attributes['city_id'])) {
            $name = City::where('id', $this->attributes['city_id'])->firstOrFail()->name;
        return $name;
        }

    }
}