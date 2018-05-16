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


}
