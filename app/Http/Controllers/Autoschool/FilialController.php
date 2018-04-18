<?php

namespace App\Http\Controllers\Autoschool;

use App\Models\Training\School\AutoSchoolFilial;
use App\Models\Training\School\AutoSchoolGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FilialController extends Controller
{
    public function index()
    {
        $filials = AutoSchoolFilial::where('auto_school_id', '=', Auth::user()->autoschoolgroup->auto_school_filial_id)->get();
        return view('autoschool.index.index', compact('filials'));
    }
    public function editPage(){
        return view('autoschool.index.edit');
    }

    public function createFilial(Request $request){

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        if (count($validator->errors())) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $filial = AutoSchoolFilial::create([
            'auto_school_id' => Auth::user()->autoschoolgroup->autoschoolfilial->autoschool->id,
            'name' => $request->input('name'),
            'address' => $request->input('address'),
        ]);

        return response()->json(['status' => 1, 'group' => $filial], 201);
    }

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
           'auto_school_filial_id' => Auth::user()->autoschoolgroup->autoschoolfilial->id,
           'name' => $request->input('name'),
           'exam_date' => $request->input('exam_date'),
           'exam_time' => $request->input('exam_time')
        ]);

        return response()->json(['status' => 1, 'group' => $group], 201);
    }
}
