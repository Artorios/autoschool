<?php

namespace App\Providers;

use App\Services\AnswerCheck\AnswerCheck;
use Illuminate\Support\ServiceProvider;

/**
 * Class AnswerCheckProvider
 * @package App\Providers
 */
class AnswerCheckProvider extends ServiceProvider
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
        $this->app->bind('AnswerCheck', function(){
            return new AnswerCheck();
        });
    }
}
