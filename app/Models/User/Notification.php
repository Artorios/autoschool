<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'notify',
        'status',
    ];
}
