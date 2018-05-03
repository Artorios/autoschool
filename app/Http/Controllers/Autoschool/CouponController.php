<?php

namespace App\Http\Controllers\Autoschool;

use App\Http\Controllers\Controller;
use App\Models\Finance\Coupon;
use App\Models\Location\City;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::whereIn('status', ['1','2','3'])->orderBy('generation_date', 'asc')->with('user')->with('school')->with('group')->get();
        return view('autoschool.coupons.index', compact('coupons'));
    }

    public function sell()
    {

    }

}
