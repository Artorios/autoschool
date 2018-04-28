<?php

namespace App\Http\Controllers\Autoschool;

use App\Models\Training\School\{
    AutoSchool, AutoSchoolFilial, AutoSchoolGroup
};
use App\Models\User\User;
use Illuminate\Support\Facades\{
    Auth, Validator
};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilialController extends Controller
{

    /**
     * @return view autoschool.filials.school_filials($filials - filials list)
     */
    public function index()
    {
        $filials = AutoSchool::orderBy('id','asc')->where('director_id', Auth::user()->id)->with('addresses')->with('city')->get();
        $autoschool = AutoSchool::find(Auth::user()->autoschoolgroup->auto_school_id);
        return view('autoschool.filials.school_filials', compact('filials', 'autoschool'));
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

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        if (count($validator->errors())) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $autoschool = AutoSchool::where('id', $request->input('id'))->first();
        $filial = AutoSchool::create([
            'filial_name' => $request->input('name'),
            'city_id' => $request->input('city_id'),
            'title' => $autoschool->title,
            'description' => $autoschool->description,
            'director_id' => Auth::user()->id,
            'investor_id' => 0,
        ]);

        $filial->contacts()->create(['type' => 'address', 'value' => $request->input('address')]);

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
        ]);

        if (count($validator->errors())) {
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

    public function show($id, AutoSchoolGroup $group)
    {
        $filial = AutoSchool::where('id', $id)->first();
        $groups = $group->where(['auto_school_id' => $id])->get();
        return view('autoschool.filials.filial_groups', compact('filial', 'groups'));
    }


    public function showStudents($id, User $user){

//        $students = $user->where(['auto_school_group_id' => $id])->whereNotIn('role', ['admin','investor','autoschool'])->get();

        return view('autoschool.students.list');
    }
}