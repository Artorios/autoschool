<?php

namespace App\Http\Controllers\Admin\UserActions;

use App\Http\Requests\Admin\{
    CreateUserInAdmin, SearchUser, UpdateUserInAdmin
};
use App\Models\Training\School\AutoSchool;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Psy\Exception\ErrorException;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin\UserActions
 */
class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listUsers(User $user, AutoSchool $autoSchool)
    {
        $users_list = $user->with('autoschoolgroup')->with('city')->with('orders')->with('coupons')->get()->toArray();
        $schools = $autoSchool->get()->toArray();

        $users = array_map(function ($user) use ($schools) {
            foreach ($schools as $school) {
                if (isset($user['autoschool']) && $user['autoschool'] === $school['id']) {
                    $user['school'] = $school;
                }
            }
            return $user;
        }, $users_list);

        $role = 'all';

        return view('admin.user.index', compact('users', 'role'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */


    public function listUsersRole(User $user, AutoSchool $autoSchool, $role){

        $users_list = $user->where('role', $role)->with('autoschoolgroup')->with('city')->with('orders')->with('coupons')->get()->toArray();
        $schools = $autoSchool->get()->toArray();

        $users = array_map(function ($user) use ($schools) {
            foreach ($schools as $school) {
                if (isset($user['autoschool']) && $user['autoschool'] === $school['id']) {
                    $user['school'] = $school;
                }
            }
            return $user;
        }, $users_list);



        return view('admin.user.index', compact('users', 'role'));

    }

    /**
     * @param User $user
     * @param UpdateUserInAdmin $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(User $user, UpdateUserInAdmin $request)
    {


        $user->update($request->validated());

        return response()->json(['status' => 1], 202);

    }

    /**
     * @param CreateUserInAdmin $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateUserInAdmin $request)
    {

        $data = $request->validated();
        $data['password'] = '123456';
        $data['license'] = "A";
        $data['city_id'] = "565";
        User::create($data);

        return response()->json(['status' => $data], 201);

    }

    public function listStudents()
    {
        return view('admin.students.index');
    }

    public function getListStudents()
    {
        $data = AutoSchool::join('auto_school_groups', 'auto_schools.id', '=', 'auto_school_groups.auto_school_id')
            ->join('users', 'auto_school_groups.id', '=', 'users.auto_school_group_id')
            ->join('cities', 'users.city_id', '=', 'cities.id')
            ->leftjoin('coupons', 'users.id', '=', 'coupons.student_id')
            ->select(['*',
                'users.name as studentName',
                'users.second_name as studentSecondName',
                'users.last_name as studentLastName',
                'cities.name as cityName',
                'auto_schools.title as AutoschoolName',
                'auto_school_groups.name as AutoschoolGroupName',
                'users.phone as UserPhone',
                'users.email as UserEmail',
                'coupons.status as CuponStatus',
            ])
            ->get();
        return response()->json([
            'data' => $data
        ], 201);
    }
}
