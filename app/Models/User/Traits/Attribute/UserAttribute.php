<?php

namespace App\Models\User\Traits\Attribute;
use App\Models\Finance\Coupon;
use App\Models\Finance\Order;
use App\Models\Training\Lesson\Lesson;
use App\Models\User\UserLesson;

/**
 * Trait UserAttribute
 * @package App\Models\User\Traits\Attribute
 */
trait UserAttribute
{
    /**
     * @param string $value
     *
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->second_name} {$this->last_name}";
    }

    public function getLessonNowAttribute()
    {
        if(Lesson::where('license', $this->attributes['license'])->count() > 1)
        {
            $userLesson = UserLesson::where('user_id', $this->attributes['id'])->where('done', 0)->orderBy('id', 'ASC')->first();
            if(empty($userLesson)){
                $userLesson = UserLesson::where('user_id', $this->attributes['id'])->where('done', 1)->orderBy('id', 'DESC')->first();
            }
            if(empty($userLesson) ) {
                return Lesson::all()->where('lesson_num', 1)->first();
            }
            return Lesson::where('id', $userLesson->lesson_id)->firstOrFail();
        }
        else{
            return 0;
        }

    }
    public function getProgressAttribute()
    {
        $trainings = $this->lessonsTrainings()->with('questions')->get();
        $tickets = $this->tickets()->get();
        $exams = $this->exams()->with('questions')->get();
        $count_all = 0;
        $correct_all = 0;
        $count_training = 0;
        $correct_training = 0;
        $count_ticket = 0;
        $correct_ticket = 0;
        $count_exam = 0;
        $correct_exam = 0;

        foreach ($trainings as $training){
            $count_training += $training->questions()->count();
            $correct_training += $training->questions()->where('correct',1)->count();
        }
        foreach ($tickets as $ticket){
            $count_ticket += $ticket->answers_count;
            $correct_ticket += $ticket->right_answers_count;
        }
        foreach ($exams as $exam){
            $count_exam += $exam->questions()->count();
            $correct_exam += $exam->questions()->where('correct',1)->count();
        }
        $count_all = $count_training + $count_ticket + $count_exam;
        $correct_all = $correct_training + $correct_ticket + $correct_exam;
        if($count_all === 0){
            $percent = '';
        }
        else{
            $percent = round($correct_all/$count_all*100);
        }

        return $percent;
    }
    public function getLastExamAttribute()
    {
        $last = $this->exams()->where('status', 0)->orderBy('created_at', 'desc')->first();
        if(empty($last)){
            $last = $this->exams()->where('status', 1)->orderBy('created_at', 'desc')->first();
        }
        if(empty($last)){
            $last = 0;
        }
        return $last;
    }

    public function getPayAttribute()
    {
        $coupon = Coupon::where('student_id', $this->attributes['id'])->where('status', 3)->count();
        $order = Order::where('user_id', $this->attributes['id'])->count();
        if($coupon > 0 || $order > 0){
            return true;
        }
        else {
            return false;
        }
    }

}
