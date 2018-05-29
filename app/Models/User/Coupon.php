<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use App\Models\User\Traits\Relationship\CouponRelationship;

class Coupon extends Model
{
    use CouponRelationship;

    protected $fillable = [
        'investor_id',
        'auto_school_id',
        'auto_school_group_id',
        'code',
        'student_id',
        'generation_date',
        'payment_amount',
        'fee_amount',
        'status',
        'activated_at',
    ];
}
