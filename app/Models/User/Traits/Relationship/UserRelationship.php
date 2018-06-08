<?php

namespace App\Models\User\Traits\Relationship;

use App\Models\Finance\Coupon;
use App\Models\Finance\Order;
use App\Models\Location\City;
use App\Models\Training\School\AutoSchool;
use App\Models\User\Contract;
use App\Models\User\InvestorInfo;
use App\Models\User\UserLessonVideo;
use App\Models\User\UserTicket;
use App\Models\User\UserSettings;
use App\Models\Training\Exam\Exam;
use App\Models\User\SocialAccount;
use App\Models\Training\Lesson\Lesson;
use App\Models\User\UserLessonTraining;
use App\Models\Training\Lesson\LessonVideo;
use App\Models\Training\School\AutoSchoolGroup;

/**
 * Trait UserRelationship.
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

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function contract()
    {
        return $this->hasOne(Contract::class);
    }

    public function autoschoolgroup()
    {
        return $this->hasOne(AutoSchoolGroup::class, 'id', 'auto_school_group_id');
    }

    public function info()
    {
        return $this->hasOne(InvestorInfo::class);
    }

    public function videos(){
        return $this->hasMany(UserLessonVideo::class,'user_id', 'id');
    }

    public function orders(){
        return $this->belongsTo(Order::class);
    }

    public function coupons(){
        return $this->belongsTo(Coupon::class);
    }
}
