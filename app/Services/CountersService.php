<?php

namespace App\Services;

use App\Models\Training\School\AutoSchool;
use Illuminate\Support\Facades\Auth;

class CountersService{

    public function getCountStudentsInAutoSchool($auto_school_id)
    {
        return AutoSchool::join('auto_school_filials','auto_schools.id','=','auto_school_filials.auto_school_id')
            ->join('auto_school_groups','auto_school_filials.id','=','auto_school_groups.auto_school_filial_id')
            ->join('users','auto_school_groups.id','=','users.auto_school_group_id')
            ->where('auto_school_id','=', $auto_school_id)
            ->whereNotIn('role',['admin','investor','autoschool'])
            ->select(['*', 'auto_school_groups.name as autoSchoolGroupName'])
            ->count();
    }

    public function getCountStudentInFilial($auto_school_id)
    {
        $collection =  AutoSchool::with('filials')
            ->join('auto_school_filials','auto_schools.id','=','auto_school_filials.auto_school_id')
            ->join('auto_school_groups','auto_school_filials.id','=','auto_school_groups.auto_school_filial_id')
            ->join('users','auto_school_groups.id','=','users.auto_school_group_id')
            ->where('auto_school_id','=', $auto_school_id)
            ->whereNotIn('role',['admin','investor','autoschool'])
            ->select(['*', 'auto_school_groups.name as autoSchoolGroupName'])
            ->get();
        return $collection->groupby('auto_school_filial_id')->toArray();
    }

}