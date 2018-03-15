<?php

namespace App\Services\AnswerCheck;

use App\Models\Training\Processing\Answer;

/**
 * Class AnswerCheck
 * @package App\Services\AnswerCheck
 */
class AnswerCheck implements AnswerCheckInterface
{

    /**
     * @param Answer $answer
     *
     * @return array
     */
    public function check(Answer $answer)
    {
        $answer->makeVisible('correct');

        if ( ! $answer->correct) {
            $right_answer = Answer::where([
                'question_id' => $answer->question_id,
                'correct'     => 1,
            ])->first()->makeVisible('correct');

            return ['correct' => 0, 'answer_id' => $right_answer->id];
        } else {
            return ['correct' => 1, 'answer_id' => $answer->id];
        }
    }
}

/**
 * Class QuestionExeption
 * @package App\Services\AnswerCheck
 */
class QuestionException extends \ErrorException {}