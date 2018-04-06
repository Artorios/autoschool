<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'name',
        'user_id'
    ];
    public $timestamps = false;

}
