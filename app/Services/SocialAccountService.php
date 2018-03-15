<?php

namespace App\Services;

use App\Models\User\User;
use App\Models\User\SocialAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

//use App\Traits\ImageUploadTrait;
//use App\Traits\ReferralTrait;

/**
 * Class SocialAccountService
 * @package App\Services
 */
class SocialAccountService
{
    //use ImageUploadTrait, ReferralTrait;

    /**
     * Create new user or linked for current
     *
     * @param $providerUser
     *
     * @return User
     */
    public function createOrGetUser($providerUser, $provider)
    {
        $account = SocialAccount::whereProvider($provider)
            ->whereProviderUserId($providerUser->id)
            ->first();

        if ($account) {
            return $account->user;
        } else {
            Log::info(json_encode($providerUser));

            $account = new SocialAccount([
                'nickname'         => $providerUser->nickname ?: null,
                'provider_user_id' => $providerUser->id,
                'provider'         => $provider,
            ]);

            $user = Auth::check() ? Auth::user() : User::where('email', $providerUser->email)->first();

            if ( ! $user) {
                $names = explode(' ', $providerUser->name);

                $user = User::create([
                    'activated' => $providerUser->email ? 1 : 0,
                    'email'     => $providerUser->email,
                    'password'  => bcrypt(str_random(8)),
                    'name'      => isset($names[0]) ? $names[0] : null,
                    'last_name' => isset($names[1]) ? $names[1] : null,
                ]);

                //$this->getAvatar($user, $providerUser);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }

    /**
     * @param User $user
     * @param      $providerUser
     *
     * @return bool
     */
    private function getAvatar($user, $providerUser)
    {
        if ($providerUser->avatar) {
            $path = $this->uploadAvatar($providerUser->avatar);

            $user->update(['avatar' => $path]);
        }

        return true;
    }
}