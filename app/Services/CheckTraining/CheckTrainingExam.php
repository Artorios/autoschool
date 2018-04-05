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
        $this->training = $training;
    }

    /**
     * @param null | array $questions
     * @return array
     */
    public function check($questions = null)
    {
        $lesson = Lesson::find($this->training->lesson_id);

        $type = $this->training->type;

        if ( ! $questions && $type === 'training') {
            $questions = $this->training->questions()->get()->pluck('question_id')->toArray();

            $lesson_questions = $lesson->questions()->get()->pluck('id')->toArray();

            $nonanswer_questions = array_diff($lesson_questions, $questions);
        } else {
            $lesson_questions = $this->training->questions()->get()->pluck('question_id')->toArray();

            $nonanswer_questions = array_diff($questions, $lesson_questions);
        }

        foreach ($nonanswer_questions as $question) {
            $this->training->questions()->create(['question_id' => $question, 'correct' => 0, 'answer_id' => 0]);
        }

        $questions_failed = $this->training->questions()->where('correct', 0)->count();

        if ($type == 'training') {
            if ($questions_failed >= $lesson->training_errors_num) {
                return ['status' => 'failed'];
            } else {
                return ['status' => 'passed'];
            }
        } else {
            $count_errors = count($questions) * $lesson->exam_errors_num / 100;

            if ($questions_failed > floor($count_errors)) {
                return ['status' => 'failed'];
            } else {
                return ['status' => 'passed'];
            }
        }
    }

}

/**
 * Class CheckTrainingException
 * @package App\Services\CheckTraining
 */
class CheckTrainingException extends \ErrorException {}