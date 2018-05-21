<?php

namespace App\Http\Controllers\Admin\UserActions;

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
        $users    = User::paginate($per_page);

        return view('admin.user.index', compact('users'));
    }

    /**
     * @param User    $user
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(User $user, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'string|min:3',
            'email'       => 'email',
            'role'        => Rule::in([ 'admin', 'moderator', 'user' ]),
            'last_name'   => 'string',
            'second_name' => 'string',
            'phone'       => 'string',
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        try {
            $user->update($request->only(['name', 'email', 'role', 'last_name', 'second_name', 'phone']));

            return response()->json(['status' => 1], 202);
        } catch (ErrorException $e) {
            return response()->json(['status' => 0], 400);
        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|min:3',
            'email'       => 'required|email|unique:users,email',
            'role'        => Rule::in([ 'admin', 'autoschool','investor', 'user' ]),
            'last_name'   => 'required|string',
            'second_name' => 'required|string',
            'phone'       => 'required|string',
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        try {
            $data             = $request->only([ 'name', 'email', 'role', 'last_name', 'second_name', 'phone' ]);
            $data['password'] = '123456';

            User::create($data);

            return response()->json(['status' => 1], 201);
        } catch (ErrorException $e) {
            return response()->json(['status' => 0], 400);
        }
    }
}
