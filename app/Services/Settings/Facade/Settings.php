<?php

namespace App\Services\Settings\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class Settings
 * @package App\Services\Settings\Facade
 */
class Settings extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Settings';
    }
}