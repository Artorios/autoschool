<?php

namespace App\Models\Training\Lesson\Traits\Attribute;

use App\Models\Training\Lesson\Lesson;
use Illuminate\Support\Facades\Auth;

/**
 * Trait LessonAttribute
 * @package App\Models\Training\Lesson\Traits\Attribute
 */
trait LessonAttribute
{
    /**
     * @param int $val
     *
     * @return void
     */
    public function setLockedAttribute($val = 0)
    {
        $this->attributes['locked'] = $val;
    }

    /**
     * @return mixed
     */
    public function getNextLessonAttribute()
    {
        return Lesson::where('license', Auth::user()->license)->orderBy('lesson_num', 'ASC' )->where('lesson_num', '>', $this->lesson_num)->first();
    }

    /**
     * @return int
     */
    public function getLockedAttribute()
    {
        $user = Auth::user();
        $exams = $user->lessonsTrainings->where('type', 'exam')->where('status', 'passed');
        $lesson = Lesson::where('license', $this->attributes['license'])->where('lesson_num',  '<',  $this->attributes['lesson_num'])->orderBy('lesson_num', 'DESC')->first();
        if($lesson == null){
            return 0;
        }
        foreach ($exams as $exam){
            if($exam->lesson_id == $lesson->id){
                if(Auth::user()->pay == true){
                    return 0;
                }
                else return 1;
            }
        }


        return 1;// $this->attributes['locked'] ?? 1;
    }

    /**
     * @return bool
     */
    public function getIsGroupAttribute()
    {
        $group_lesson_num = 3;

        return (integer) $this->lesson_num % $group_lesson_num == 0;
    }
}
