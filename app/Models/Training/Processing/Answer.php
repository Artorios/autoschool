<?php

namespace App\Models\Training\Processing;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Answer
 * @package App\Models\Training\Processing
 */
class Answer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'correct',
        'question_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['correct'];
}
