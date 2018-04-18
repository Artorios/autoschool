<?php

namespace App\Http\Controllers\Autoschool;

use App\Models\Training\School\{
    AutoSchoolFilial, AutoSchoolGroup, AutoSchool
};
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class AutoschoolController
 * @package App\Http\Controllers\Autoschool
 */
class AutoschoolController extends Controller
{

    /**
     * @return mixed
     */
    public function index()
    {
//        return dd(Auth::user()->autoschoolgroup->autoschoolfilial);
        $filials = AutoSchoolFilial::where('auto_school_id', '=', Auth::user()->autoschoolgroup->autoschoolfilial->auto_school_id)->get();
        $groups = [];
        foreach ($filials as $filial){
            if(!empty(AutoSchoolGroup::where('auto_school_filial_id', '=', $filial->id)->get()[0])){
                array_push($groups, AutoSchoolGroup::where('auto_school_filial_id', '=', $filial->id)->get());
            }


        }
        return view('autoschool.filials.filial_groups', compact('groups'));
    }

    /**
     * @return mixed
     */
    public function editPage(){
        return view('autoschool.index.edit');
    }

    public function getCountMain(AutoSchoolGroup $autoSchoolGroup, User $user){
        $filials = AutoSchoolFilial::where('auto_school_id', '=', Auth::user()->autoschoolgroup->autoschoolfilial->auto_school_id)->get();
        $groups = [];
        foreach ($filials as $filial){
            if(!empty(AutoSchoolGroup::where('auto_school_filial_id', '=', $filial->id)->get()[0])){
                array_push($groups, AutoSchoolGroup::where('auto_school_filial_id', '=', $filial->id)->get());
            }
        }
        $counts = 0;

        foreach ($groups[0] as $group){
            $counts += $user->where(['auto_school_group_id' => $group->id])->whereNotIn('role', ['admin','investor','autoschool'])->count();
        }

        return response()->json(['counts' => $counts, 'coupons' => 0, 'income' => 0]);
    }

    private function countOfStudent(){
//        $users = User::all()->where('id', '=', );
//        return $users;
    }
}
