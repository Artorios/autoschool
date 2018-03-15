<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 05.03.18
 * Time: 22:47
 */

namespace App\Services\LessonRules;


use App\Models\Training\Lesson\Lesson;

interface LessonRulesInterface
{
    public function checkRules(Lesson $lesson);
}