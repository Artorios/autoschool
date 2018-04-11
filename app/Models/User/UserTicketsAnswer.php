<?php

namespace App\Models\User;

use App\Models\Training\Processing\Answer;
use App\Models\Training\Processing\Question;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserTicketsAnswer
 * @package App\Models\User
 */
class UserTicketsAnswer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['correct', 'question_id', 'answer_id', 'user_tickets_id'];

    public function answers()
    {
        return $this->hasMany(Answer::class, 'id', 'answer_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'id', 'question_id');
    }
}
