<?php

namespace App\Models\Training\Lesson\Traits\Relationship;

use App\Models\Training\Lesson\LessonVideo;
use App\Models\Training\Processing\Question;

/**
 * Trait LessonRelationship
 * @package App\Models\Training\Lesson\Traits\Relationship
 */
trait LessonRelationship
{
    /**
     * @return mixed
     */
    public function videos()
    {
        return $this->hasMany(LessonVideo::class, 'lesson_id', 'id');
    }

    /**
     * @return mixed
     */
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'lesson_questions', 'lesson_id', 'question_id');
    }
}
