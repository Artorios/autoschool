<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'user_id',
        'operation',
        'comment',
    ];
}