<?php

namespace App\Transformers;

use App\Models\Training\School\AutoSchoolGroup;
use App\Models\Finance\Coupon;
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
        $coupon->load('fees');
        return [
            'id' => $coupon->id,
            'name' => $coupon->code,
            'student_name' => $coupon->student->name ?? '',
            'student_surname' => $coupon->student->last_name ?? '',
            'group_id' => $coupon->group ? $coupon->group->id_number : '',
            'status' => isset($coupon->fees->id) ?  5  : $coupon->status,
            'autoschool' => [
                'id' => $coupon->autoSchool->id,
                'title' => $coupon->autoSchool->title,
                'city' => DB::table('cities')->where('id', $coupon->autoSchool->city_id)->first()
            ],
            'date' => [
                'generation' => $coupon->generation_date,
                'activation' => $coupon->activated_at   ,
                'sale' => $coupon->sale_date   ,
            ],
            'generate' => $coupon->generation_date,
            'amount' => [
                'payment' => $coupon->payment_amount,
                'commission' => $coupon->fee_amount,
            ],
            'comment' => [
                'investor' => $coupon->comment_investor,
                'director' => $coupon->comment_director,
                'coupon' => $coupon->comment_coupon,
            ],
            'updated_at' => (string) $coupon->updated_at
        ];
    }
}
