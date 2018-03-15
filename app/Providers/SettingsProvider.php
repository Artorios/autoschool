<?php

namespace App\Providers;

use App\Services\Settings\Settings;
use Illuminate\Support\ServiceProvider;

/**
 * Class SettingsProvider
 * @package App\Providers
 */
class SettingsProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Settings', function(){
            return new Settings();
        });
    }
}
