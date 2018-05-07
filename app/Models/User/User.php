<?php

namespace App\Models\User;

use App\Models\User\Traits\Attribute\UserAttribute;
use App\Models\User\Traits\Method\UserMethod;
use App\Models\User\Traits\Relationship\UserRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Training\School\AutoSchool;
use App\Models\Training\School\AutoSchoolGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * @package App\Models\User
 */
class User extends Authenticatable
{
    use Notifiable,
        UserRelationship,
        UserAttribute,
        UserMethod;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'last_name',
        'second_name',
        'phone',
        'activated',
        'confirmation_code',
        'auto_school_group_id',
        'license',
        'city_id',
        'image'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $appends = ['autoschool'];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAutoschoolAttribute()
    {   if(!empty(Auth::user()->auto_school_group_id)){
        $id = AutoSchool::find(Auth::user()->autoschoolgroup->auto_school_id)->id;
    }
    else{
        return false;
    }
        return $id;
    }

}
