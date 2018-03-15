<?php

namespace App\Models\User\Traits\Relationship;

use App\Models\User\UserTicketsAnswer;

/**
 * Trait UserTicketRelationship
 * @package App\Models\User\Traits\Relationship
 */
trait UserTicketRelationship
{
    /**
     * @return mixed
     */
    public function answers()
    {
        return $this->hasMany(UserTicketsAnswer::class, 'user_tickets_id', 'id');
    }

    /**
     * @return mixed
     */
    public function getRightAnswersCountAttribute()
    {
        return $this->hasMany(UserTicketsAnswer::class, 'user_tickets_id', 'id')->where('correct', 1)->count();
    }

    /**
     * @return mixed
     */
    public function getIncorrectAnswersCountAttribute()
    {
        return $this->hasMany(UserTicketsAnswer::class, 'user_tickets_id', 'id')->where('correct', 0)->count();
    }

    /**
     * @return mixed
     */
    public function getAnswersCountAttribute()
    {
        return $this->hasMany(UserTicketsAnswer::class, 'user_tickets_id', 'id')->count();
    }
}
