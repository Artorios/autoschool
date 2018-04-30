<?php

namespace App\Models\Training\School\Traits\Scope;

/**
 * Trait AutoSchoolScope
 * @package App\Models\Training\School\Traits\Scope
 */
trait AutoSchoolScope
{
    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeInvestor($query, $id)
    {
        return $query->where('investor_id', $id);
    }
}