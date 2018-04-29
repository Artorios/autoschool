<?php

namespace App\Http\Controllers\Investor;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\User\InvestorProfile;
use App\Http\Requests\Investor\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('investor.profile.edit', [
            'profile' => InvestorProfile::where('user_id', Auth::id())
                ->with('legalEntity', 'individual', 'legalAddress', 'bankDetails', 'contact')
                ->first(),
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
        if (! $profile = InvestorProfile::where('user_id', Auth::id())->first()) {
            return redirect()->back()->withInput($request->all())->withErrors(['Профиль инвестора не найден']);
        }

        $profile->update([
            'active_config' => $request->get('active_config'),
        ]);

        return redirect()->route('investor.profile.index')->with('messages', ['Профиль успешно обновлен']);
    }
}
