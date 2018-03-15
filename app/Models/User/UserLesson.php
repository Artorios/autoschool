<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserLesson
 * @package App\Models\User
 */
class UserLesson extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_lessons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['done', 'lesson_id', 'user_id'];
}
