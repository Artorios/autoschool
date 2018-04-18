<?php

namespace App\Http\Controllers\Autoschool;

use App\Models\Training\School\AutoSchoolFilial;
use App\Models\Training\School\AutoSchoolGroup;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AutoschoolController extends Controller
{
    public function index()
    {
        $groups = AutoSchoolGroup::where('auto_school_filial_id', '=', Auth::user()->autoschoolgroup->autoschoolfilial->id)->get();
        return view('autoschool.filials.filial_groups', compact('groups'));
    }
    public function editPage(){
        return view('autoschool.index.edit');
    }

    private function countOfStudent(){
//        $users = User::all()->where('id', '=', );
//        return $users;
    }
}
