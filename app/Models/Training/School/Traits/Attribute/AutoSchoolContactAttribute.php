<?php

namespace App\Models\Training\School\Traits\Attribute;

/**
 * Trait AutoSchoolContactAttribute
 * @package App\Models\Training\School\Traits\Attribute
 */
trait AutoSchoolContactAttribute
{
    /**
     * @return string
     */
    public function getTypeNameAttribute()
    {
        switch ($this->attributes['type']) {
            case 'address':
                return 'Адрес';
                break;
            case 'phone':
                return 'Телефон';
                break;
        }
    }
}
