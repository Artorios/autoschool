<?php

namespace App\Http\Controllers\Autoschool;

use App\Models\Training\School\AutoSchool;
use App\Models\Training\School\AutoSchoolGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Support\Facades\Auth;

class AutoschoolController extends Controller
{
    public function editPage(){


        return view('autoschool.index.edit');
    }

    public function getCountMain(AutoSchoolGroup $autoSchoolGroup, User $user){
        $autoschool = AutoSchool::find(Auth::user()->autoschool);
        $groups = $autoSchoolGroup->where(['auto_school_id' => $autoschool->id])->get();
        $counts = 0;
        foreach ($groups as $group){
            $counts += $user->where(['auto_school_group_id' => $group->id])->whereNotIn('role', ['admin','investor','autoschool'])->count();
        }
        return response()->json(['counts' => $counts, 'coupons' => 0, 'income' => 0]);
    }
}
