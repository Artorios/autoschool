<?php

namespace App\Http\Controllers\Investor;

use App\Transformers\CouponTransformer;
use Illuminate\Support\Facades\{
    DB, Auth
};
use Carbon\Carbon;
use App\Models\User\{
    History, Coupon
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

    /*
    public function list()
    {
        $couppons = Coupon::where('investor_id', Auth::id())->get();
        return fractal($couppons, new CouponTransformer())->respond();
//        return Coupon::where('investor_id', Auth::id())
//            ->with('autoSchool.city', 'group', 'student')
//            ->get();
    }
    */

    public function create()
    {
        return view('investor.coupons.create', [
            'auto_schools' => AutoSchool::where('investor_id', Auth::id())->get(),
        ]);
    }

    public function store(StoreCouponRequest $request)
    {
        $auto_school_id = $request->get('auto_school');

        DB::beginTransaction();
        for ($i = 0; $i < $request->get('count'); $i++) {
            Coupon::create([
                'investor_id'     => Auth::id(),
                'auto_school_id'  => $auto_school_id,
                'code'            => "$auto_school_id-" . strtolower(str_random(7)),
                'fee_amount'      => $request->get('fee_amount'),
                'generation_date' => Carbon::now()->toDateString(),
            ]);
        }

        History::create([
            'investor_id'    => Auth::id(),
            'auto_school_id' => $auto_school_id,
            'operation'      => 'Генерация купонов',
        ]);
        DB::commit();

        return redirect()->route('investor.coupons.create')->with('messages', ['Купоны успешно созданны']);
    }
}
