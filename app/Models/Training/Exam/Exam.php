<?php

namespace App\Models\Training\Exam;

use App\Models\Training\Exam\ExamQuestion;
use App\Models\Training\Processing\Question;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LessonsSettings
 * @package App\Models\Training\Exam
 */
class Exam extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'type',
        'status',
        'id'
    ];

    protected $appends = ['right_answer_count','all_answer_count'];

    public function questions()
    {
        return $this->hasMany(ExamQuestion::class, 'exam_id', 'id');
    }
    public function getRightAnswerCountAttribute()
    {
        return $this->questions()->where('correct', 1)->count();
    }
    public function getAllAnswerCountAttribute()
    {
        return $this->questions()->count();
    }
}