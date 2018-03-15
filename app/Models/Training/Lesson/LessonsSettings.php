<?php

namespace App\Models\Training\Lesson;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LessonsSettings
 * @package App\Models\Training\Lesson
 */
class LessonsSettings extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['key', 'value', 'title'];
}
