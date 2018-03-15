<?php

namespace App\Models\Training\Processing;

use App\Models\Training\Processing\Traits\Attribute\QuestionAttribute;
use App\Models\Training\Processing\Traits\Relationship\QuestionRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 * @package App\Models\Training\Processing
 */
class Question extends Model
{
    use QuestionRelationship, QuestionAttribute;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['description', 'comment', 'ticket_num', 'question_num', 'id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image', 'checked'];
}
