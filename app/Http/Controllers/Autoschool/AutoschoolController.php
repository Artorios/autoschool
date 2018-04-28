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
     * @return array
     */
    public function index(AutoSchoolGroup $group)
    {
        $filials = AutoSchool::select('id')->where('director_id', Auth::user()->id)->get();
        $groups_id = [];
        foreach ($filials as $filial){
            array_push($groups_id, $filial->id);
        }

        $groups = AutoSchoolGroup::whereIn('auto_school_id', $groups_id)->get();

        return view('autoschool.index.index', compact('groups'));
    }

    /**
     * @return mixed
     */
    public function editPage(){
        return view('autoschool.index.edit');
    }
    /**
     * @return array
     */
    public function getCountMain(){

        $filials = AutoSchool::select('id')->where('director_id', Auth::user()->id)->get();
        $filials_id = [];
        foreach ($filials as $filial){

            array_push($filials_id, $filial->id);

        }
        $groups = AutoSchoolGroup::all()->whereIn('auto_school_id', $filials_id);
        $groups_id = [];
        foreach ($groups as $group){
            array_push($groups_id, $group->id);
        }
        $counts = User::all()->whereIn('auto_school_group_id',$groups_id)->whereIn('role', ['user'])->count();



        return response()->json(['counts' => $counts, 'coupons' => 0, 'income' => 0]);
    }

    public function getCountFilials($filial_id){


        $groups = AutoSchoolGroup::where('auto_school_id', $filial_id)->get();
        $groups_id = [];

        foreach ($groups as $group){
            array_push($groups_id, $group->id);
        }

        $counts = User::all()->whereIn('auto_school_group_id', $groups_id)->whereIn('role', ['user'])->count();



        return response()->json(['counts' => $counts, 'coupons' => 0, 'income' => 0]);
    }



    private function countOfStudent(){
//        $users = User::all()->where('id', '=', );
//        return $users;
    }







}