<?php

namespace App\Services\AnswerCheck\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class AnswerCheck
 * @package App\Services\AnswerCheck\Facade
 */
class AnswerCheck extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'AnswerCheck';
    }
}