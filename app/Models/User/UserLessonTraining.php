<?php

namespace App\Models\User;

use App\Models\User\Traits\Relationship\UserLessonTrainingRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserLessonTraining
 * @package App\Models\User
 */
class UserLessonTraining extends Model
{
    use UserLessonTrainingRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['lesson_id', 'user_id', 'complete', 'type', 'status'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}
