<?php

namespace App\Http\Controllers\Admin\UserActions;

use App\Http\Requests\Admin\CreateUserInAdmin;
use App\Http\Requests\Admin\SearchUser;
use App\Http\Requests\Admin\UpdateUserInAdmin;
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
        $users_list = $user->with('autoschoolgroup')->get()->toArray();
        $schools = $autoSchool->get()->toArray();

        $users = array_map(function ($school, $user) {
            if($school['id'] === $user['autoschool']){
                $user['school'] = $school;
            }
            return $user;
        }, $schools, $users_list);

        return view('admin.user.index', compact('users'));
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


}
