<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'investor_id',
        'auto_school_id',
        'operation',
        'comment',
    ];
}