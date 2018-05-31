<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserLessonVideo
 * @package App\Models\User
 */
class UserLessonVideo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_lesson_videos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['time_stop_view', 'viewed', 'lesson_video_id', 'user_id', 'updated_at'];
}
