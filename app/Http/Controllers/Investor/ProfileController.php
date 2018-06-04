<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\User\InvestorProfile;
use App\Http\Requests\Investor\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $investor = Auth::user()->load('info');
        return view('investor.profile.edit', compact('investor'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $investor_id = Auth::id();

        if (!$profile = InvestorProfile::where('user_id', $investor_id)->first()) {
            return response()->json([
                'errors' => ['Профиль инвестора не найден'],
                'data' => false,
            ], 404);
        }

        $profile->update([
            'active_config' => $request->get('active_config'),
        ]);

        Cache::forget("investor_profile_$investor_id");

        return response()->json([
            'messages' => ['Профиль успешно обновлен'],
            'data' => true,
        ], 204);
    }
}
