<?php

namespace App\Http\Controllers\Autoschool;

use App\Http\Controllers\Controller;
use App\Http\Requests\SellCoupon;
use App\Models\Finance\Coupon;
use App\Models\Location\City;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::whereIn('status', ['1','2','3'])->orderBy('generation_date', 'asc')->with('user')->with('school')->with('group')->get();
        return view('autoschool.coupons.index', compact('coupons'));
    }

    public function sell(SellCoupon $coupon)
    {
        $count = Coupon::whereIn('id',$coupon->validated()['id'])->where('status' , 1)->count();
        Coupon::whereIn('id',$coupon->validated()['id'])->where('status' , 1)->update([
            'status' => 2,
            'comment_director' => $coupon->validated()['comment_director']
        ]);
        return response()->json(['count' => $count],'201');
    }

}
