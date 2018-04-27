<?php

namespace App\Http\Controllers\Autoschool;

use App\Models\Training\School\{
    AutoSchoolFilial, AutoSchoolGroup, AutoSchool, AutoSchoolInfo
};
use App\Models\User\User;
use App\Http\Controllers\Controller;
use App\Services\CountersService;
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
        $info_about_school = auth()->user()->autoschoolgroup->autoschoolfilial->autoschool->info;
        return view('autoschool.index.edit', compact('info_about_school'));
    }

    /**
     * @param AutoSchoolGroup $autoSchoolGroup
     * @param  User                          $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCountMain(CountersService $countersService)
    {
        $autoschool = AutoSchool::findOrFail(Auth::user()->autoschoolgroup->autoschoolfilial->auto_school_id);

        return response()->json([
            'counts' => $countersService->getCountStudentsInAutoSchool($autoschool->id),
            'coupons' => 0,
            'income' => 0
        ]);
    }

}
