<?php

namespace App\Models\User\Traits\Relationship;

use App\Models\Location\City;
use App\Models\Training\Exam\Exam;
use App\Models\Training\Lesson\Lesson;
use App\Models\Training\Lesson\LessonVideo;
use App\Models\Training\School\AutoSchoolGroup;
use App\Models\User\Contract;
use App\Models\User\SocialAccount;
use App\Models\User\UserSettings;
use App\Models\User\UserLessonTraining;
use App\Models\User\UserTicket;

/**
 * Trait UserRelationship
 * @package App\Models\User\Traits\Relationship
 */
trait UserRelationship
{
    /**
     * @return mixed
     */
    public function userSettings()
    {
        return $this->belongsToMany(UserSettings::class);
    }

    /**
     * @return mixed
     */
    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class, 'user_id', 'id');
    }

    /**
     * @return mixed
     */
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'user_lessons', 'user_id', 'lesson_id')->withPivot(['done']);
    }

    /**
     * @return mixed
     */
    public function lessonsVideos()
    {
        return $this->belongsToMany(LessonVideo::class, 'user_lesson_videos', 'user_id', 'lesson_video_id')->withPivot(['time_stop_view', 'viewed']);
    }

    /**
     * @return mixed
     */
    public function lessonsTrainings()
    {
        return $this->hasMany(UserLessonTraining::class, 'user_id', 'id');
    }

    /**
     * @return mixed
     */
    public function tickets()
    {
        return $this->hasMany(UserTicket::class, 'user_id', 'id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'user_id', 'id');
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function contract()
    {
        return $this->hasOne(Contract::class);
    }

    public function autoschoolgroup(){
        return $this->hasOne(AutoSchoolGroup::class, 'id', 'auto_school_group_id');
    }




}
