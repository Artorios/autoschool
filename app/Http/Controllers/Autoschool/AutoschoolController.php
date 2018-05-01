<?php

namespace App\Http\Controllers\Autoschool;

use App\Models\Training\School\{
    AutoSchoolGroup, AutoSchool
};
use App\Models\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class AutoschoolController
 * @package App\Http\Controllers\Autoschool
 */
class AutoschoolController extends Controller
{

    /**
     * @param  AutoSchoolGroup $group
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(AutoSchoolGroup $group)
    {
        $filials = AutoSchool::select('id')->where('director_id', Auth::user()->id)->get()->toArray();

        $groups_id = array_map(function ($filial) {
            return $filial['id'];
        }, $filials);

        $groups = AutoSchoolGroup::whereIn('auto_school_id', $groups_id)->get();

        return view('autoschool.index.index', compact('groups'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPage()
    {
        return view('autoschool.index.edit');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCountMain()
    {

        $filials = AutoSchool::select('id')->where('director_id', Auth::user()->id)->get()->toArray();
        $filials_id = array_map(function ($filial) {
            return $filial['id'];
        }, $filials);
        $groups = AutoSchoolGroup::all()->whereIn('auto_school_id', $filials_id)->toArray();
        $groups_id = array_map(function ($group) {
            return $group['id'];
        }, $groups);

        $counts = User::all()->whereIn('auto_school_group_id', $groups_id)
            ->whereIn('role', ['user'])
            ->count();

        return response()->json(['counts' => $counts, 'coupons' => 0, 'income' => 0]);
    }

    /**
     * @param  integer $filial_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCountFilials($filial_id)
    {
        $groups = AutoSchoolGroup::where('auto_school_id', $filial_id)->get()->toArray();
        $groups_id = array_map(function ($group) {
            return $group['id'];
        }, $groups);
        $counts = User::all()->whereIn('auto_school_group_id', $groups_id)
            ->whereIn('role', ['user'])
            ->count();

        return response()->json(['counts' => $counts, 'coupons' => 0, 'income' => 0]);
    }

}
