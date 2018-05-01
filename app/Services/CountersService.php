<?php

namespace App\Services;

use App\Models\Training\School\AutoSchool;
use App\Models\Training\School\AutoSchoolGroup;
use App\Models\User\User;
use Illuminate\Support\Facades\Auth;

class CountersService{

    /**
     * @return int, count of students in AutoSchool
     */
    public function getCountStudentsInAutoSchool()
    {
        $filials = AutoSchool::select('id')->where('director_id', Auth::user()->id)->get()->toArray();
        $filials_id = array_map(function ($filial) {
            return $filial['id'];
        }, $filials);
        $groups = AutoSchoolGroup::all()->whereIn('auto_school_id', $filials_id)->toArray();
        $groups_id = array_map(function ($group) {
            return $group['id'];
        }, $groups);

        return User::all()->whereIn('auto_school_group_id', $groups_id)
            ->whereIn('role', ['user'])
            ->count();

    }

    public function getCountFreeCupon()
    {
        return 0;
    }

    public function getCountIncomeAutoSchool()
    {
        return 0;
    }



}