<?php

namespace App\Services\CheckTraining;

use App\Models\Training\Exam\Exam;
use App\Models\Training\Lesson\Lesson;
use App\Models\User\UserLessonTraining;

/**
 * Class CheckTraining
 * @package App\Services\CheckTraining
 */
class CheckTraining
{
    /**
     * @var UserLessonTraining
     */
    protected $exams;

    /**
     * CheckTraining constructor.
     *
     * @param UserLessonTraining $training
     */
    function __construct(Exam $exams)
    {
        $this->exams = $exams;
    }

    /**
     * @param null | array $questions
     * @return array
     */
    public function check($questions = null)
    {
        
    }

}

/**
 * Class CheckTrainingException
 * @package App\Services\CheckTraining
 */
class CheckTrainingException extends \ErrorException {}