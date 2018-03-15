<?php

namespace App\Models\Training\Processing\Traits\Attribute;

use Illuminate\Support\Facades\Storage;

/**
 * Trait QuestionAttribute
 * @package App\Models\Training\Processing\Traits\Attribute
 */
trait QuestionAttribute
{
    /**
     * @return null|string
     */
    public function getImageAttribute()
    {
        $path = snake_case(class_basename($this)) . "/$this->id";

        if ( ! Storage::disk('public')->exists($path)) {
            return null;
        }

        $files = Storage::disk('public')->allFiles($path);

        if ( ! count($files)) {
            return null;
        }

        return env('APP_URL') . '/storage/' . $files[0];
    }

    /**
     * @param int $val
     */
    public function setCheckedAttribute($val = 0) {
        $this->attributes['checked'] = $val;
    }

    /**
     * @return int
     */
    public function getCheckedAttribute()
    {
        return $this->attributes['checked'] ?? 0;
    }
}
