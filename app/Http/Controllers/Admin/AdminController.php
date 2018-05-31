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

/**
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class AdminController extends Controller
{

    public function getInvestorsApi(Request $request)
    {
        $q = $request->input('q');

        return response()->json(User::select('id', 'email', 'last_name')->where('email', 'like', '%' . $q . '%')->where('role', 'investor')->limit(10)->get(), 200);

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

    public function searchUser(SearchUser $request)
    {
        $error = ['error' => 'Не найдено!'];

        if (!empty($request->validated()['q'])) {

            $users = User::select('id', 'role', 'name', 'email', 'last_name', 'phone')->where('email', 'like', '%' . $request->validated()['q'] . '%')->get();

            return $users->count() ? $users : $error;
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
