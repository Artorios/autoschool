<?php

namespace App\Models\Training\Lesson\Traits\Attribute;

use App\Models\Training\Lesson\Lesson;
use Illuminate\Support\Facades\Auth;

/**
 * Trait LessonAttribute
 * @package App\Models\Training\Lesson\Traits\Attribute
 */
trait LessonAttribute
{
    /**
     * @param int $val
     *
     * @return void
     */
    public function setLockedAttribute($val = 0)
    {
        $this->attributes['locked'] = $val;
    }

    /**
     * @return mixed
     */
    public function getNextLessonAttribute()
    {
        return Lesson::where('license', Auth::user()->license)->orderBy('lesson_num', 'ASC' )->where('lesson_num', '>', $this->lesson_num)->first();
    }

    /**
     * @return int
     */
    public function getLockedAttribute()
    {
        return $this->attributes['locked'] ?? 1;
    }

    /**
     * @return bool
     */
    public function getIsGroupAttribute()
    {
        $group_lesson_num = 3;

        return (integer) $this->lesson_num % $group_lesson_num == 0;
    }
}
