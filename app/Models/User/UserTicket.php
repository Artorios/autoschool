<?php

namespace App\Models\User;

use App\Models\User\Traits\Relationship\UserTicketRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserTicket
 * @package App\Models\User
 */
class UserTicket extends Model
{
    use UserTicketRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ticket_num', 'user_id', 'status'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['right_answers_count', 'incorrect_answers_count', 'answers_count'];
}
