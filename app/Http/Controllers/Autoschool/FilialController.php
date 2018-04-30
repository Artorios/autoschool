<?php

namespace App\Http\Controllers\Autoschool;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFilial;
use App\Models\Training\School\{
    AutoSchool, AutoSchoolGroup
};
use App\Models\User\User;
use Illuminate\Support\Facades\{
    Auth, Validator, DB
};
use Illuminate\Http\Request;

class FilialController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $filials = AutoSchool::orderBy('id', 'asc')
            ->where('director_id', Auth::user()->id)
            ->with('addresses')
            ->with('city')
            ->get();
        $autoschool = AutoSchool::find(Auth::user()->autoschoolgroup->auto_school_id);

        return view('autoschool.filials.school_filials', compact('filials', 'autoschool'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPage()
    {
        return view('autoschool.index.edit');
    }

    /**
     * @param  StoreFilial $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createFilial(StoreFilial $request)
    {
        DB::transaction(function () use ($request) {
            $filial = AutoSchool::create($request);
            $filial->contacts()->create([
                'type'  => 'address',
                'value' => $request->post('address')
            ]);
        });
        return response()->json(['status' => 1], 201);
    }

    /**
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createGroup(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'exam_date' => 'required|date',
            'exam_time' => 'required|date_format:H:i',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $group = AutoSchoolGroup::create([
            'auto_school_id' => $request->input('id'),
            'name' => $request->input('name'),
            'exam_date' => $request->input('exam_date'),
            'exam_time' => $request->input('exam_time')
        ]);

        return response()->json(['status' => 1, 'group' => $group], 201);
    }

    /**
     * @param $id
     * @param AutoSchoolGroup $group
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id, AutoSchoolGroup $group)
    {
        $filial = AutoSchool::where('id', $id)->first();
        $groups = $group->where(['auto_school_id' => $id])->get();
        return view('autoschool.filials.filial_groups', compact('filial', 'groups'));
    }

    /**
     * @param  integer $id
     * @param  User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showStudents($id, User $user)
    {
        /*
                $students = $user->where(['auto_school_group_id' => $id])->whereIn('role', ['user'])->count();
                foreach($students as $student){
                    $fio = $student->last_name[0];
                    $student->setAttribute('fio', $fio);
                }
        */
        return view('autoschool.students.list');//, compact('students'));
    }
}