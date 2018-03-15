<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SocialAccountService;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

/**
 * Class SocialAuthController
 * @package App\Http\Controllers\Auth
 */
class SocialAuthController extends Controller
{
       /**
     * Redirect to social site for getting data
     *
     * @param $provider
     *
     * @return mixed
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Return callback from social with data
     *
     * @param SocialAccountService $service
     * @param                      $provider
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function callback(SocialAccountService $service, $provider)
    {
        try {
            $user = $service->createOrGetUser(Socialite::driver($provider)->user(), $provider);

            Auth::login($user);

            return redirect('/');
        } catch (\Exception $e) {
            \Log::error('Social auth error ' . $e->getMessage());

            return redirect('/');
        }
    }
}
