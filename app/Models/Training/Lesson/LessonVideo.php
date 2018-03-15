<?php

namespace App\Models\Training\Lesson;

use App\Models\Training\Lesson\Traits\Attribute\LessonVideoAttribute;
use App\Models\Training\Lesson\Traits\Relationship\LessonVideoRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LessonVideo
 * @package App\Models\Training\Lesson
 */
class LessonVideo extends Model
{
    use LessonVideoRelationship, LessonVideoAttribute;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['mime_type', 'name', 'lesson_id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['path'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    //protected $with = ['userVideos'];
}
