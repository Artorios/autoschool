<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SearchUser;
use App\Http\Resources\SchoolsCollection;
use App\Models\Location\{
    City, Region
};
use App\Models\Training\School\{
    AutoSchool, AutoSchoolGroup
};
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class AdminController extends Controller
{

    public function getInvestorsApi(Request $request, $region)
    {
        $q = $request->input('q');
        $user = Auth::user();
        $cities = City::where('regions_id', $region)->get()->toArray();
        $cities_id = array_map(function ($city) {
            return $city['id'];
        }, $cities);

        return response()->json(User::select('id', 'email', 'last_name')->whereIn('city_id', $cities_id)->where('email', 'like', '%' . $q . '%')->where('role', 'investor')->limit(10)->get(), 200);

    }

    public function getDirectorsApi(Request $request)
    {
        $q = $request->input('q');
        return response()->json(User::select('id', 'email', 'last_name')->where('email', 'like', '%' . $q . '%')->where('role', 'autoschool')->limit(10)->get(), 200);

    }

    public function getSchoolData(Request $request)
    {

        $items = $request->all();

        $city = City::where('id', $items['city_id'])->with('region')->firstOrFail();
        $director = 0;
        $investor = 0;
        if (!empty($request->input('director_id'))) {
            $director = User::select('email', 'name', 'last_name')->where('id', $request->input('director_id'))->firstOrFail();
        }
        if (!empty($request->input('investor_id'))) {
            $investor = User::select('email', 'name', 'last_name')->where('id', $request->input('investor_id'))->firstOrFail();
        }

        return response()->json(['city' => $city, 'director' => $director, 'investor' => $investor], 202);
    }

    public function searchUser(SearchUser $request, $role)
    {
        $error = ['error' => 'Не найдено!'];

        if (!empty($request->validated()['q'])) {

            switch ($role) {
                case 'all':
                    $users = User::search($request->validated()['q'])->get();
                    break;

                case 'user':
                    $students = User::search($request->validated()['q'])->get()->toArray();
                    $users = array_map(function ($user){
                        if($user['role'] == 'user'){
                            return $user;
                        }
                    }, $students);
                    break;

                case 'admin':
                    $admins = User::search($request->validated()['q'])->get()->toArray();
                    $users = array_map(function ($user){
                        if($user['role'] == 'admin'){
                            return $user;
                        }
                    }, $admins);
                    break;

                case 'autoschool':
                    $autoschools = User::search($request->validated()['q'])->get()->toArray();
                    $users = array_map(function ($user){
                        if($user['role'] == 'autoschool'){
                            return $user;
                        }
                    }, $autoschools);
                    break;

                case 'investor':
                    $investors = User::search($request->validated()['q'])->get()->toArray();
                    $users = array_map(function ($user){
                        if($user['role'] == 'investor'){
                            return $user;
                        }
                    }, $investors);
                    break;

            }

            return count($users) ? $users : $error;
        }

        return $error;
    }

    public function getAutoSchoolApi(Request $request)
    {
        $q = $request->input('q');
        return response()->json(AutoSchool::select('id', 'title', 'filial_name')->where('title', 'like', '%' . $q . '%')->limit(10)->get(), 200);

    }

    public function getSchoolGroupApi(Request $request, $id)
    {
        $q = $request->input('q');
        return response()->json(AutoSchoolGroup::select('id', 'name')->where('auto_school_id', $id)->where('name', 'like', '%' . $q . '%')->limit(10)->get(), 200);

    }

    public function getSchool($id)
    {

        return new SchoolsCollection(AutoSchool::find($id));
    }

}
