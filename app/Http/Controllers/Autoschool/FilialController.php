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

class FilialController extends Controller
{

    /**
     * @return mixed
     */
    public function index(CountersService $countersService)
    {
        $autoschool = AutoSchool::findOrFail(Auth::user()->autoschoolgroup->autoschoolfilial->auto_school_id);
        $collection = $countersService->getCountStudentInFilial($autoschool->id);
        foreach ($autoschool->filials as $filial){
            if (in_array($filial->id, array_keys($collection))) {
                $filial->setAttribute('student_count', count($collection[$filial->id]));
            }else{
                $filial->setAttribute('student_count', 0);
            }
        }
        return view('autoschool.filials.school_filials', compact('autoschool'));
    }

    /**
     * @return mixed
     */
    public function editPage(){
        return view('autoschool.index.edit');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function createFilial(Request $request){

        $test = $this->validate($request, [
            'name'    => 'required|string|max:255',
                           'address' => 'required|string|max:255',
                           'auto_school_id' => 'required|integer',
        ]);
dd($test);
        /**
         * $this->validate($request->all(), [
         *  'name'     => 'required|string|max:255',
         *  'address' => 'required|string|max:255',
         *  ])
         */

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        if (count($validator->errors())) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $filial = AutoSchoolFilial::create([
            'auto_school_id' => $request->input('id'),
            'name' => $request->input('name'),
            'address' => $request->input('address'),
        ]);

        return response()->json(['status' => 1, 'group' => $filial], 201);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function createGroup(Request $request){

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'exam_date' => 'required|date',
            'exam_time' => 'required|date_format:H:i',
            'auto_school_filial_id' => 'required|integer',

        ]);

        if (count($validator->errors())) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $group = AutoSchoolGroup::create([
           'auto_school_filial_id' => $request->input('id'),
           'name' => $request->input('name'),
           'exam_date' => $request->input('exam_date'),
           'exam_time' => $request->input('exam_time')
        ]);

        return response()->json(['status' => 1, 'group' => $group], 201);
    }

    public function show($id)
    {
        $filial = AutoSchoolFilial::findOrFail($id);

        foreach ($filial->autoschoolgroups as $one){
            $one->setAttribute('student_counts', User::where('auto_school_group_id', '=', $one->id)
                ->whereNotIn('role', ['admin','investor','autoschool'])
                ->count());
        }
            $groups = $filial->autoschoolgroups;
        return view('autoschool.filials.filial_groups', compact('groups', 'filial'));
    }

    public function showStudents($id, $group_id,  User $user){
        $students = $user->where(['auto_school_group_id' => $group_id])
            ->whereNotIn('role', ['admin','investor','autoschool'])
            ->get();
        $group = AutoSchoolGroup::where('id', '=', $group_id)->get()[0];
        return view('autoschool.filials.students_list', compact('students', 'group'));
    }
}
