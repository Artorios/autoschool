<?php

namespace App\Models\User;

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
}
