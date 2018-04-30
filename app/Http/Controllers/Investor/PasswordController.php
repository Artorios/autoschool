<?php

namespace App\Http\Controllers\Investor;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Investor\UpdatePasswordRequest;

class PasswordController extends Controller
{
    public function __invoke(UpdatePasswordRequest $request)
    {
        Auth::user()->update([
            'password' => bcrypt($request->get('password')),
        ]);

        return redirect()->route('investor.profile.index')->with('messages', ['Пароль успешно обновлен']);
    }
}
