<?php

namespace App\Transformers;

use App\Models\Training\School\AutoSchoolGroup;
use App\Models\Finance\Coupon;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;
use League\Fractal\TransformerAbstract;

class SchoolFeeCouponTransformer extends TransformerAbstract
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
            'auto_school_id' => $coupon->auto_school_id,
            'summ' => $coupon->fee_amount,
            'investor_id' => $coupon->investor_id,
            'comment' => $coupon->comment_investor,
            'coupon_id' => $coupon->id,

        ];
    }
}
