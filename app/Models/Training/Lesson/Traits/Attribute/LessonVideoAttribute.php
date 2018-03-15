<?php

namespace App\Models\Training\Lesson\Traits\Attribute;

/**
 * Trait LessonVideoAttribute
 * @package App\Models\Training\Lesson\Traits\Attribute
 */
trait LessonVideoAttribute
{
    /**
     * @return string
     */
    public function getPathAttribute()
    {
        return env('APP_URL') . '/storage/' . snake_case(class_basename($this)) . '/' .$this->id . '/' . $this->name;
    }
}
