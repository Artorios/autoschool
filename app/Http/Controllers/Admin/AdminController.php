<?php

namespace App\Http\Controllers\Admin;

use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class AdminController extends Controller
{
    public function getInvestors(){

        $investors = User::all()->toArray();//select('id','email')->where('role', 'investor')->get();

        return response()->json(['investors' => $investors], 200);

    }

    public function getDirectors(){

        $directors = User::select('id','email')->where('role', 'autoschool')->get();


        return response()->json(['directors' => $directors], 200);

    }

    public function getInvestorsApi(Request $request){
        $q = $request->input('q');

        return response()->json(User::select('id','email','last_name')->where('email', 'like', '%' . $q . '%')->where('role','investor')->limit(10)->get(), 200);

    }

    public function getDirectorsApi(Request $request){
        $q = $request->input('q');

        return response()->json(User::select('id','email','last_name')->where('email', 'like', '%' . $q . '%')->where('role','autoschool')->limit(10)->get(), 200);

    }

}
