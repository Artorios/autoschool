<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserSchool extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_schools';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['user_id', 'school_id', 'status'];
}
