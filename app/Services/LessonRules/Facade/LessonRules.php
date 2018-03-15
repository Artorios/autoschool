<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 05.03.18
 * Time: 22:50
 */

namespace App\Services\LessonRules\Facade;


use Illuminate\Support\Facades\Facade;

class LessonRules extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'LessonRules';
    }
}