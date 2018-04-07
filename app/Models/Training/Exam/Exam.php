<?php

namespace App\Models\Training\Exam;

use App\Models\Training\ExamQuestion\ExamQuestion;
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
    public function questions()
    {
        return $this->hasMany(ExamQuestion::class, 'exam_id', 'id');
    }
}