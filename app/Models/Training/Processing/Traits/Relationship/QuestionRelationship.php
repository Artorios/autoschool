<?php

namespace App\Models\Training\Processing\Traits\Relationship;

use App\Models\Training\Processing\Answer;

/**
 * Trait QuestionRelationship
 * @package App\Models\Training\Processing\Traits\Relationship
 */
trait QuestionRelationship
{
    /**
     * @return mixed
     */
    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }
}
