<?php

namespace App\Services\AnswerCheck;

use App\Models\Training\Processing\Answer;

/**
 * Interface AnswerCheckInterface
 * @package App\Services\AnswerCheck
 */
interface AnswerCheckInterface
{
    /**
     * @param Answer $answer
     *
     * @return mixed
     */
    public function check(Answer $answer);
}