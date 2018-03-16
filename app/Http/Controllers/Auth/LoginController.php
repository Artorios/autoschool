<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Psy\Exception\ErrorException;

/**
 * Class LoginController
 * @package App\Http\Controllers\Auth
 */
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function auth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|string|min:6',
        ]);
        $validator->validate();

        $user = User::where(['email' => $request->email])->first();

        if (count($validator->errors()) || ! $user) {
            return response()->json(['status' => 0], 400);
        }

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $response = redirect()->intended('/');

            return response()->json(['status' => 1, 'url' => $response->headers->get('location')], 202);
        } else {
            return response()->json(['errors' => ['login' => 'Неверный Email или пароль']], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        try {
            Auth::logout();

            return redirect('/');
        } catch (ErrorException $e) {
            return response()->json(['status' => 0 ], 400);
        }
    }

    /**
     * @param $token
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function activateUser($token)
    {
        $user = User::where('confirmation_code', $token)->firstOrFail();

        $user->activated = 1;
        $user->confirmation_code = null;
        $user->save();

        return redirect('/');
    }
}
