<?php

namespace App\Models\User;

use App\Models\Training\School\AutoSchool;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'investor_id',
        'auto_school_id',
        'operation',
        'comment',
    ];

    public function school()
    {
        return $this->belongsTo(AutoSchool::class, 'auto_school_id', 'id');
    }
}