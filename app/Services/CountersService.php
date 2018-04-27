<?php

namespace App\Services;

use App\Models\Training\School\AutoSchool;
use Illuminate\Support\Facades\Auth;

class CountersService{

    /**
     * @param $auto_school_id
     * @return mixed
     */
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

    /**
     * @param $auto_school_id
     * @return array key => id_filial, val => array data
     */
    public function getCountStudentInFilials($auto_school_id)
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

    /**
     * @param $filial_id
     * @return array key => id_group, var => array users
     */
    public function getCountStudentInEachGroup($filial_id)
    {
        $collection = AutoSchool::with('filials')
            ->join('auto_school_filials','auto_schools.id','=','auto_school_filials.auto_school_id')
            ->join('auto_school_groups','auto_school_filials.id','=','auto_school_groups.auto_school_filial_id')
            ->join('users','auto_school_groups.id','=','users.auto_school_group_id')
            ->where('auto_school_filial_id','=', $filial_id)
            ->whereNotIn('role',['admin','investor','autoschool'])
            ->select(['*', 'auto_school_groups.id as auto_school_group_id'])
            ->get();
        return $collection->groupby('auto_school_group_id')->toArray();
    }


    /**
     * @param $filial_id
     * @return mixed
     */
    public function getCountStudentsInGroups($filial_id)
    {
        return AutoSchool::join('auto_school_filials','auto_schools.id','=','auto_school_filials.auto_school_id')
            ->join('auto_school_groups','auto_school_filials.id','=','auto_school_groups.auto_school_filial_id')
            ->join('users','auto_school_groups.id','=','users.auto_school_group_id')
            ->where('auto_school_filial_id','=', $filial_id)
            ->whereNotIn('role',['admin','investor','autoschool'])
            ->select(['*', 'auto_school_groups.name as autoSchoolGroupName'])
            ->count();
    }

    public function getCountFreeCupon()
    {
        return 0;
    }

    public function getCountIncomeFilial()
    {
        return 0;
    }

    public function getCountIncomeAutoSchool()
    {
        return 0;
    }



}