<?php

namespace App\Http\Controllers\Investor;

use App\Http\Requests\CanceledCoupon;
use App\Http\Requests\Investor\SellCouponRequest;
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
        return view('investor.coupons.index');
    }

    public function all()
    {
        $couppons = Coupon::where('investor_id', Auth::id())->where('status', '!=', '4')->orderBy('generation_date', 'desc')
            ->get()
            ->load('student');
        return fractal($couppons, new CouponTransformer())->respond();
    }

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
                'investor_id' => Auth::id(),
                'auto_school_id' => $auto_school_id,
                'code' => "$auto_school_id-" . strtolower(str_random(7)),
                'fee_amount' => $request->get('fee_amount'),
                'generation_date' => Carbon::now()->toDateString(),
            ]);
        }

        History::create([
            'investor_id' => Auth::id(),
            'auto_school_id' => $auto_school_id,
            'operation' => 'Генерация купонов',
        ]);
        DB::commit();

        return redirect()->route('investor.coupons.create')->with('messages', ['Купоны успешно созданны']);
    }

    /**
     * @param SellCouponRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sell(SellCouponRequest $request)
    {
        $count = Coupon::whereIn('id', $request->get('id'))->where('status', 1)->count();
        if (!$count) {
            Coupon::whereIn('id', $request->get('id'))->where('status', 1)->update([
                'status' => 2,
                'comment_investor' => $request->validated()['comment_investor']
            ]);
        }
        return response()->json(['count' => $count], '201');
    }

    /**
     * @param SellCouponRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function comment(SellCouponRequest $request)
    {
        $count = Coupon::whereIn('id', $request->get('id'))->where('status', 3)->count();
        if (!$count) {
            Coupon::whereIn('id', $request->get('id'))->where('status', 3)->update([
                'status' => 2,
                'comment_investor' => $request->validated()['comment_investor']
            ]);
        }
        return response()->json(['countTop' => $count], '201');
    }

    /**
     * @param CanceledCoupon $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function canceled(CanceledCoupon $request)
    {
        Coupon::whereIn('id', $request->get('id'))->update([
            'status' => 4
        ]);
        $this->notification(Auth::user()->id, "Было ануллировано купоны, в количестве - ".count($request->get('id')).".");
        return response()->json(['status' => 1], '201');
    }

    /**
     * @param CanceledCoupon $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(CanceledCoupon $request)
    {
        Coupon::whereIn('id', $request->get('id'))->delete();
        $this->notification(Auth::user()->id, "Было удалено купоны, в количестве - ".count($request->get('id')).".");

        return response()->json([], '201');
    }
}
