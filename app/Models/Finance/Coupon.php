<?php

namespace App\Models\Finance;

use App\Models\Training\School\AutoSchool;
use App\Models\Training\School\AutoSchoolGroup;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','investor_id', 'auto_school_id','user_id',
        'generation_date','activation_date','sale_date','total','commission','status','comment_investor','comment_director'];


    public function user(){
        return $this->belongsTo(User::class, 'student_id', 'id');
    }
    public function school(){
        return $this->belongsTo(AutoSchool::class, 'auto_school_id', 'id');
    }

    public function group(){
        return $this->belongsTo(AutoSchoolGroup::class, 'auto_school_group_id', 'id');
    }
}
