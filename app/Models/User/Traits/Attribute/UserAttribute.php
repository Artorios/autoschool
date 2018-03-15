<?php

namespace App\Models\User\Traits\Attribute;

/**
 * Trait UserAttribute
 * @package App\Models\User\Traits\Attribute
 */
trait UserAttribute
{
    /**
     * @param string $value
     *
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
