<?php

namespace App\Models\Training\School;

use Illuminate\Database\Eloquent\Model;

class SchoolFee extends Model
{
    protected $fillable = [
        'auto_school_id',
        'comment',
        'summ',
        'investor_id'
    ];
}
