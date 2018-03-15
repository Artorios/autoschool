<?php

namespace App\Models\User\Traits\Relationship;

use App\Models\User\UserLessonTrainingQuestion;

/**
 * Trait UserLessonTrainingRelationship
 * @package App\Models\User\Traits\Relationship
 */
trait UserLessonTrainingRelationship
{
    /**
     * @return mixed
     */
    public function questions()
    {
        return $this->hasMany(UserLessonTrainingQuestion::class, 'user_lesson_training_id', 'id');
    }
}
