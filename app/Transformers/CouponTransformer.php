<?php

namespace App\Transformers;

use App\Models\Training\School\AutoSchoolGroup;
use App\Models\User\Coupon;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;
use League\Fractal\TransformerAbstract;

class CouponTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Coupon $coupon
     * @return array
     */
    public function transform(Coupon $coupon)
    {
        return [
            'id' => $coupon->id,
            'name' => $coupon->code,
            'student_name' => User::find($coupon->student_id)->name ?? '',
            'group_id' => $coupon->auto_school_group_id,
            'status' => $coupon->status,
            'autoschool' => [
                'id' => $coupon->autoSchool->id,
                'title' => $coupon->autoSchool->title,
                'city' => DB::table('cities')->where('id', $coupon->autoSchool->city_id)->first()
            ],
            'date' => [
                'generation' => $coupon->generation_date,
                'activation' => $coupon->activated_at   ,
            ],
            'amount' => [
                'payment' => $coupon->payment_amount,
                'commission' => $coupon->commision_amount,
            ],
            'updated_at' => (string) $coupon->updated_at
        ];
    }
}
