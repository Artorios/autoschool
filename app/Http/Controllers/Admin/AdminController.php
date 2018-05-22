<?php

namespace App\Http\Controllers\Admin;

use App\Models\Location\City;
use App\Models\Location\Region;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class AdminController extends Controller
{

    public function getInvestorsApi(Request $request){
        $q = $request->input('q');

        return response()->json(User::select('id','email','last_name')->where('email', 'like', '%' . $q . '%')->where('role','investor')->limit(10)->get(), 200);

    }

    public function getDirectorsApi(Request $request){
        $q = $request->input('q');

        return response()->json(User::select('id','email','last_name')->where('email', 'like', '%' . $q . '%')->where('role','autoschool')->limit(10)->get(), 200);

    }
    public function getSchoolData(Request $request){

        $items = $request->all();

        $city = City::where('id', $items['city_id'])->with('region')->firstOrFail();
        $region = $city->region;
        $director = 0;
        $investor = 0;
        if(!empty($request->input('director_id'))){
            $director = User::select('email','name','last_name')->where('id',$request->input('director_id'))->firstOrFail();
        }
        if(!empty($request->input('investor_id'))){
            $investor = User::select('email','name','last_name')->where('id',$request->input('investor_id'))->firstOrFail();
        }

        return response()->json(['city' => $city, 'region' => $region, 'director' => $director, 'investor' => $investor], 202);
    }

}
