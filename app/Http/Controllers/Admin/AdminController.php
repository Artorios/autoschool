<?php

namespace App\Http\Controllers\Admin;

use App\Models\Location\{City, Region};
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DirectorsCollection;
/**
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class AdminController extends Controller
{

    public function getInvestorsApi(Request $request){
        $q = $request->input('q');

        return response()->json(User::select('id','email','last_name')->where('email', 'like', '%' . $q . '%')->where('role','autoschool')->limit(10)->get(), 200);

    }

    public function getDirectorsApi(Request $request){
        $q = $request->input('q');
        $directors = User::where('email', 'like', '%' . $q . '%')
            ->where('role','autoschool')
            ->limit(10)
            ->get();
        return (new DirectorsCollection($directors))->response()->setStatusCode(200);

    }
    public function getSchoolData(Request $request){

        $items = $request->all();

        $city = City::where('id', $items['city_id'])->with('region')->firstOrFail();
        $director = 0;
        $investor = 0;
        if(!empty($request->input('director_id'))){
            $director = User::select('email','name','last_name')->where('id',$request->input('director_id'))->firstOrFail();
        }
        if(!empty($request->input('investor_id'))){
            $investor = User::select('email','name','last_name')->where('id',$request->input('investor_id'))->firstOrFail();
        }

        return response()->json(['city' => $city,  'director' => $director, 'investor' => $investor], 202);
    }

}
