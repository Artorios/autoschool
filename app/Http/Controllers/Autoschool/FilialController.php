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
        $collection = $countersService->getCountStudentInFilial($autoschool->id);
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

        // Return Resource instead of this
        // https://laravel.com/docs/5.6/eloquent-resources
        return response()->json(['status' => 1, 'group' => $filial], 201);
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

        // Return Resource instead of this
        // https://laravel.com/docs/5.6/eloquent-resources
        return response()->json(['status' => 1, 'group' => $group], 201);
    }

    /**
     * @param  integer                                                  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $filial = AutoSchoolFilial::findOrFail($id);

        foreach ($filial->autoschoolgroups as $one) {
            $one->setAttribute('student_counts', User::where('auto_school_group_id', '=', $one->id)
                ->whereNotIn('role', ['admin', 'investor', 'autoschool'])
                ->count());
        }
        $groups = $filial->autoschoolgroups;
        return view('autoschool.filials.filial_groups', compact('groups', 'filial'));
    }

    /**
     * @param integer                                                   $id
     * @param integer                                                   $group_id
     * @param User                                                      $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showStudents($id, $group_id, User $user)
    {
        $students = $user->where(['auto_school_group_id' => $group_id])
            ->whereNotIn('role', ['admin', 'investor', 'autoschool'])
            ->get();
        $group = AutoSchoolGroup::where('id', '=', $group_id)->get()[0];
        return view('autoschool.filials.students_list', compact('students', 'group'));
    }
}
