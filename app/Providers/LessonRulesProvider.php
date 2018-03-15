<?php

namespace App\Providers;

use App\Services\LessonRules\LessonRules;
use Illuminate\Support\ServiceProvider;

class LessonRulesProvider extends ServiceProvider
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
        $this->app->bind('LessonRules', function(){
            return new LessonRules();
        });
    }
}
