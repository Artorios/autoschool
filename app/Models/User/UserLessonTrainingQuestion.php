<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserLessonTrainingQuestion
 * @package App\Models\User
 */
class UserLessonTrainingQuestion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_lesson_training_id', 'question_id', 'answer_id', 'correct'];
}
