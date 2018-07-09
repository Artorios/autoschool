<?php

namespace App\Models\Finance;

use App\Models\Training\School\AutoSchool;
use App\Models\Training\School\AutoSchoolGroup;
use App\Models\Training\School\SchoolFee;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'investor_id',
        'auto_school_id',
        'auto_school_group_id',
        'code',
        'student_id',
        'generation_date',
        'activated_at',
        'sale_date',
        'payment_amount',
        'fee_amount',
        'status',
        'comment_investor',
        'comment_director',
    ];


    public function user(){
        return $this->belongsTo(User::class, 'student_id', 'id');
    }
    public function school(){
        return $this->belongsTo(AutoSchool::class, 'auto_school_id', 'id');
    }

    public function group(){
        return $this->belongsTo(AutoSchoolGroup::class, 'auto_school_group_id', 'id');
    }
    public function autoSchool()
    {
        return $this->belongsTo(AutoSchool::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class);
    }
    public function fees(){
        return $this->hasOne(SchoolFee::class, 'coupon_id', 'id');
    }
}
