<?php

namespace App\Http\Controllers\Investor;

use Auth;
use Carbon\Carbon;
use App\Models\User\Coupon;
use App\Models\Location\City;
use App\Http\Controllers\Controller;
use App\Models\Training\School\AutoSchool;
use App\Http\Requests\Investor\StoreCouponRequest;

class CouponsController extends Controller
{
    public function index()
    {
        return view('investor.coupons.index', [
            'coupons' => Coupon::where('investor_id', Auth::id())
                ->with('city', 'autoSchool', 'group', 'student')
                ->get(),
        ]);
    }

    public function create()
    {
        return view('investor.coupons.create', [
            'cities' => City::take(100)->get()->sortBy('name'),
            'auto_schools' => AutoSchool::where('investor_id', Auth::id())->get(),
        ]);
    }

    public function store(StoreCouponRequest $request)
    {
        $coupons = [];
        $investor_id = Auth::id();
        $auto_school_id = $request->get('auto_school');
        $city_id = $request->get('city');
        $commision_amount = $request->get('commision_amount');
        $timestamps = Carbon::now();
        for ($i = 0; $i < $request->get('count'); $i++) {
            $coupons[] = [
                'investor_id' => $investor_id,
                'auto_school_id' => $auto_school_id,
                'city_id' => $city_id,
                'commision_amount' => $commision_amount,
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ];
        }

        Coupon::insert($coupons);

        return redirect()->route('investor.coupons.create')->with('messages', ['Купоны успешно созданны']);
    }
}
