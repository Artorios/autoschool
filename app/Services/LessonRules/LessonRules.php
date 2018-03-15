<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 05.03.18
 * Time: 22:47
 */

namespace App\Services\LessonRules;


use App\Models\Training\Lesson\Lesson;
use Illuminate\Support\Facades\Auth;

class LessonRules implements LessonRulesInterface
{
    protected $user;
    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function checkRules(Lesson $lesson)
    {
        $lesson->with('video');
        $user_videos = $this->user->lessonsVideos()->where('lesson_id', $lesson->id)->get();

        if ( ! count($user_videos) && $lesson->videos()->count()) {
            $user_videos = $this->user->lessonsVideos()->attach($lesson->videos);

            /*
             * Set array videos for foreach
             */
            $user_videos = $this->user->lessonsVideos()->where('lesson_id', $lesson->id)->get();
        }

        $user_training = $this->user->lessonsTrainings()
            ->where(['lesson_id' => $lesson->id, 'type' => 'training'])
            ->where('status', '!=', null)
            ->first();

        if ($user_training) {
            $lesson->training_pass = 1;
        }

        if ($lesson->getIsGroupAttribute()) {
            $user_exam = $this->user->lessonsTrainings()
                ->where(['lesson_id' => $lesson->id, 'status' => 'passed', 'type' => 'exam'])
                ->first();

            if ($user_exam) {
                $lesson->exam_pass = 1;
            }
        }
        foreach ($user_videos as $user_video) {
            foreach ($lesson->videos as $video) {
                if ($user_video->id === $video->id) {
                    if ( ! $user_video->pivot->viewed) {
                        $video->time = $user_video->pivot->time_stop_view;
                    } else {
                        $video->viewed = 1;
                    }
                }
            }
        }
        return $lesson->toArray();
    }
}