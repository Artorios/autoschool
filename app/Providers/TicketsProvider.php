<?php

namespace App\Providers;

use App\Services\Tickets\Tickets;
use Illuminate\Support\ServiceProvider;

/**
 * Class TicketsProvider
 * @package App\Providers
 */
class TicketsProvider extends ServiceProvider
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
        $this->app->bind('Tickets', function(){
            return new Tickets();
        });
    }
}
