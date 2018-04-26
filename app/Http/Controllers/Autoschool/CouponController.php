<?php

namespace App\Http\Controllers\Autoschool;

use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function __invoke()
    {
        return view('autoschool.coupons.index');
    }
}
