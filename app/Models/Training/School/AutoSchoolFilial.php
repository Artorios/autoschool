<?php

namespace App\Models\Training\School;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Training\School\{ AutoSchoolGroup};
use App\Models\User\User;

class AutoSchoolFilial extends Model
{
    protected $fillable = [
        'auto_school_id',
        'name',
        'address'
    ];

    protected $appends = ['counts_students'];

    public function autoschool()
    {
        return $this->hasOne(AutoSchool::class, 'id', 'auto_school_id');
    }

    public function autoschoolgroups(){
        return $this->hasMany(AutoSchoolGroup::class);
    }

    public function getCountsStudentsAttribute()
    {
            $id_filial = $this->attributes['id'];

            $groups = AutoSchoolGroup::where('auto_school_filial_id', '=', $id_filial)->get();
            $counts = 0;
            foreach ($groups as $group) {
                $counts += User::where('auto_school_group_id', '=', $group->id)->whereNotIn('role', ['admin','investor','autoschool'])->count();
        }
        return $counts;
        }


}
