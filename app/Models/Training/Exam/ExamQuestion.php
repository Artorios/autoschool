<?php

namespace App\Models\Training\ExamQuestion;

use Illuminate\Database\Eloquent\Model;
use App\Models\Training\Processing\Question;


/**
 * Class LessonsSettings
 * @package App\Models\Training\Exam
 */
class ExamQuestion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'exam_id',
        'correct',
        'question_id',
        'answer_id'
    ];

    public function questions(){
        return $this->belongsTo(Question::class, 'id', 'question_id');
    }
}