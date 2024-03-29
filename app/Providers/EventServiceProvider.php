<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider
 * @package App\Providers
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\UserPasswordChangedEvent' => [
            'App\Listeners\UserEmailChangedListener',
        ],
        'App\Events\UserPasswordChangeRequestEvent' => [
            'App\Listeners\UserPasswordChangeRequestListener',
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            'SocialiteProviders\VKontakte\VKontakteExtendSocialite@handle',
            \JhaoDa\SocialiteProviders\Odnoklassniki\OdnoklassnikiExtendSocialite::class,
            \JhaoDa\SocialiteProviders\MailRu\MailRuExtendSocialite::class,
            'SocialiteProviders\Twitter\TwitterExtendSocialite@handle',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
