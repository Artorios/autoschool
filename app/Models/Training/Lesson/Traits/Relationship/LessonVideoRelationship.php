<?php

namespace App\Models\Training\Lesson\Traits\Relationship;

use App\Models\User\UserLessonVideo;

/**
 * Trait LessonVideoRelationship
 * @package App\Models\Training\Lesson\Traits\Relationship
 */
trait LessonVideoRelationship
{
    /**
     * @return mixed
     */
    /*public function userVideos()
    {
        return $this->hasOne(UserLessonVideo::class, 'lesson_video_id', 'id')->where('user_id', \Illuminate\Support\Facades\Auth::id());
    }*/
}
