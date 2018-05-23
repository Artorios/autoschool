<?php

namespace App\Http\Controllers\Admin\UserActions;

use App\Http\Requests\Admin\CreateUserInAdmin;
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
    public function listUsers()
    {
        $per_page = 20;
        $users    = User::all();
        $schools  = AutoSchool::whereIn('director_id', [0, null, ''])->get();
        return view('admin.user.index', compact('users', 'schools'));
    }

    /**
     * @param User    $user
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

            $data             = $request->validated();
            $data['password'] = '123456';

            User::create($data);

            return response()->json(['status' => $data], 201);

    }
}
