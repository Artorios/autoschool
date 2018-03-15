<?php

namespace App\Models\Training\Lesson\Traits\Attribute;

use App\Models\Training\Lesson\Lesson;

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
        return Lesson::where('id', '>', $this->id)->first();
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
