<?php

namespace App\Http\Controllers\Autoschool;

use App\Models\Training\School\{
    AutoSchool, AutoSchoolFilial, AutoSchoolGroup
};
use App\Models\User\User;
use App\Services\CountersService;
use Illuminate\Support\Facades\{
    Auth, Validator
};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class FilialController
 * @package App\Http\Controllers\Autoschool
 */
class FilialController extends Controller
{

    /**
     * @param  CountersService $countersService
     * @return mixed
     */
    public function index(CountersService $countersService)
    {
        $autoschool = AutoSchool::findOrFail(Auth::user()->autoschoolgroup->autoschoolfilial->auto_school_id);
        $collection = $countersService->getCountStudentInFilials($autoschool->id);
        foreach ($autoschool->filials as $filial) {
            if (in_array($filial->id, array_keys($collection))) {
                $filial->setAttribute('student_count', count($collection[$filial->id]));
            } else {
                $filial->setAttribute('student_count', 0);
            }
        }
        return view('autoschool.filials.school_filials', compact('autoschool'));
    }

    /**
     * @return mixed
     */
    public function editPage()
    {
        return view('autoschool.index.edit');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function createFilial(Request $request)
    {
        $filial = AutoSchoolFilial::create(
            $this->validate($request, [
                'name'    => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'auto_school_id' => 'required|integer',
            ])
        );

        return response()->json(['status' => 1], 201);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function createGroup(Request $request)
    {

        $group = AutoSchoolGroup::create(
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'exam_date' => 'required|date',
                'exam_time' => 'required|date_format:H:i',
                'auto_school_filial_id' => 'required|integer',
            ])
        );

        return response()->json(['status' => 1], 201);
    }

    /**
     * @param  integer                                                  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id, CountersService $countersService)
    {
        $filial = AutoSchoolFilial::findOrFail($id);
        $countStudentInGroups = $countersService->getCountStudentInEachGroup($filial->id);
        foreach ($filial->autoschoolgroups as $group) {
            if (in_array($group->id, array_keys($countStudentInGroups))) {
                $group->setAttribute('student_counts', count($countStudentInGroups[$group->id]));
            } else {
                $group->setAttribute('student_counts', 0);
            }
        }


        return view('autoschool.filials.filial_groups', compact('groups', 'filial'));
    }

    /**
     * @param integer                                                   $id
     * @param integer                                                   $group_id
     * @param User                                                      $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showStudents($group_id, User $user)
    {
        $students = $user->where(['auto_school_group_id' => $group_id])
            ->whereNotIn('role', ['admin', 'investor', 'autoschool'])
            ->get();
        $group = AutoSchoolGroup::where('id', '=', $group_id)->get()[0];
        return view('autoschool.filials.students_list', compact('students', 'group'));
    }

    /**
     * @param CountersService $countersService
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCountFilial(CountersService $countersService, Request $request)
    {
        return response()->json([
            'counts' => $countersService->getCountStudentsInGroups($request->input('id')),
            'coupons' => $countersService->getCountFreeCupon(),
            'income' => $countersService->getCountIncomeFilial()
        ]);
    }
}
