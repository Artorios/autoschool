<?php

namespace App\Http\Controllers\Investor;

use Auth;
use Cache;
use App\Http\Controllers\Controller;
use App\Models\User\InvestorProfile;
use App\Http\Requests\Investor\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function show()
    {
        $investor_id = Auth::id();

        return view('investor.profile.edit', [
            'profile' => Cache::rememberForever("investor_profile_$investor_id", function () use ($investor_id) {
                return InvestorProfile::where('user_id', $investor_id)
                    ->with('legalEntity', 'individual', 'legalAddress', 'bankDetails', 'contact')
                    ->first();
            }),
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $investor_id = Auth::id();

        if (! $profile = InvestorProfile::where('user_id', $investor_id)->first()) {
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
