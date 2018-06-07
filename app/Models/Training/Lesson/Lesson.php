<?php

namespace App\Models\Training\Lesson;

use App\Models\Training\Lesson\Traits\Attribute\LessonAttribute;
use App\Models\Training\Lesson\Traits\Relationship\LessonRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Lesson
 * @package App\Models\Training\Lesson
 */
class Lesson extends Model
{
    use LessonRelationship, LessonAttribute;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'lesson_num',
        'training_errors_num',
        'exam_errors_num',
        'license'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['locked', 'isGroup'];
}
