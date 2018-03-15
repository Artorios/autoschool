<?php

namespace App\Models\User\Traits\Relationship;

use App\Models\User\User;

/**
 * Trait SocialAccountRelationship
 * @package App\Models\User\Traits\Relationship
 */
trait SocialAccountRelationship
{
    /**
     * Relation one social account belongs to one user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
