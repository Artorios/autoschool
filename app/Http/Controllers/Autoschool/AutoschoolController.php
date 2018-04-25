<?php

namespace App\Http\Controllers\Autoschool;

use App\Models\Training\School\{
    AutoSchoolFilial, AutoSchoolGroup, AutoSchool, AutoSchoolInfo
};
use App\Models\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $autoschool = AutoSchool::findOrFail(Auth::user()->autoschoolgroup->autoschoolfilial->auto_school_id);
        foreach ($autoschool->filials as $filial) {
            $countOfUsers = 0;
            foreach (AutoSchoolGroup::where('auto_school_filial_id', '=', $filial->id)->get() as $group) {
                $countOfUsers += count($group->users->whereNotIn('role', ['admin', 'investor', 'autoschool']));
            }
            $filial->setAttribute('student_count', $countOfUsers);
        }
        return view('autoschool.filials.school_filials', compact('autoschool'));
    }

    /**
     * @return mixed
     */
    public function editPage()
    {
        $info_about_school = auth()->user()->autoschoolgroup->autoschoolfilial->autoschool->info;
        return view('autoschool.index.edit', compact('info_about_school'));
    }

    /**
     * @param AutoSchoolGroup $autoSchoolGroup
     * @param  User                          $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCountMain(AutoSchoolGroup $autoSchoolGroup, User $user)
    {
        $filials = AutoSchoolFilial::where('auto_school_id', '=', Auth::user()->autoschoolgroup->autoschoolfilial->auto_school_id)->get();
        $groups = [];
        foreach ($filials as $filial) {
            if (!empty(AutoSchoolGroup::where('auto_school_filial_id', '=', $filial->id)->get()[0])) {
                array_push($groups, AutoSchoolGroup::where('auto_school_filial_id', '=', $filial->id)->get());
            }
        }
        $counts = 0;

        foreach ($groups as $arrayGroup) {
            foreach ($arrayGroup as $group) {
                $counts += $user->where(['auto_school_group_id' => $group->id])->whereNotIn('role', ['admin', 'investor', 'autoschool'])->count();
            }
        }

        return response()->json(['counts' => $counts, 'coupons' => 0, 'income' => 0]);
    }

}
