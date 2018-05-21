<?php

namespace App\Http\Controllers\Investor;

use Illuminate\Support\Facades\{
    Auth, DB
};
use App\Models\User\{
    Coupon, History
};
use App\Http\Controllers\Controller;
use App\Models\Training\School\AutoSchool;
use App\Http\Requests\Investor\StoreCouponRequest;

class CouponsController extends Controller
{
    public function index()
    {
        return view('investor.coupons.index', [
            'coupons' => Coupon::where('investor_id', Auth::id())
                ->with('autoSchool.city', 'group', 'student')
                ->get(),
        ]);
    }

    public function create()
    {
        return view('investor.coupons.create', [
            'auto_schools' => AutoSchool::where('investor_id', Auth::id())->get(),
        ]);
    }

    public function store(StoreCouponRequest $request)
    {
        DB::beginTransaction();

        for ($i = 0, $until = $request->get('count'); $i < $until; $i++) {
            Coupon::create($request->validated());
        }

        History::create([
            'investor_id' => $request->get('investor_id'),
            'auto_school_id' => $request->get('auto_school_id'),
            'operation' => 'Генерация купонов',
        ]);

        DB::commitTransaction();

        return redirect()->route('investor.coupons.create')->with('messages', ['Купоны успешно созданны']);
    }
}
