<?php

namespace App\Models\User\Traits\Method;


/**
 * Trait UserMethod
 * @package App\Models\User\Traits\Method
 */
trait UserMethod
{
    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->attributes['role'] === 'admin';
    }
}
