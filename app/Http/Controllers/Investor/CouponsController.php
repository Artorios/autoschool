<?php

namespace App\Http\Controllers\Investor;

use App\Http\Requests\CanceledCoupon;
use App\Http\Requests\Investor\SellInvestorCoupon;
use App\Models\Training\School\SchoolFee;
use App\Transformers\CouponTransformer;
use Illuminate\Support\Facades\{
    DB, Auth
};
use Carbon\Carbon;
use App\Models\User\{
    History
};
use App\Http\Controllers\Controller;
use App\Models\Training\School\AutoSchool;
use App\Http\Requests\Investor\StoreCouponRequest;
use App\Transformers\SchoolFeeCouponTransformer;
use App\Models\Finance\Coupon;

class CouponsController extends Controller
{
    public function index()
    {
        /*$couppons = Coupon::where('investor_id', Auth::id())->where('status', '!=', '4')->where('id', 10)->orderBy('generation_date', 'desc')
            ->get()
            ->load('student')
            ->load('fees');
        return dd($couppons);*/

        return view('investor.coupons.index');
    }

    public function all()
    {
        $couppons = Coupon::where('investor_id', Auth::id())->where('status', '!=', '4')->orderBy('generation_date', 'desc')
            ->get()
            ->load('student')
            ->load('fees');


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
    public function sell(SellInvestorCoupon $request)
    {


        $count = Coupon::whereIn('id', $request->get('id'))->whereIn('status', [2, 3])->whereNull('comment_investor')->count();
        if ($count > 0) {

            DB::transaction(function () use ($request) {
                $coupons = Coupon::whereIn('id', $request->get('id'))->whereIn('status', [2, 3])->whereNull('comment_investor')->get()->toArray();
                $coupon_id = array_map(
                    function ($coupon) {
                        return $coupon['id'];
                    }
                    , $coupons);
                $as_id = array_map(
                    function ($coupon) {
                        return $coupon['auto_school_id'];
                    }
                    , $coupons);
                $as_id = array_unique($as_id);
                Coupon::whereIn('id', $request->get('id'))->whereIn('status', [2, 3])->update([
                    'comment_investor' => $request->validated()['comment_investor']
                ]);
                $coupons = Coupon::whereIn('id', $coupon_id)->get();
                foreach ($coupons as $key=>$coupon) {
                    SchoolFee::create(fractal($coupon, new SchoolFeeCouponTransformer())->toArray()['data']);
                    $history[$key]['auto_school_id'] = $coupon->auto_school_id;
                    $history[$key]['investor_id'] = Auth::user()->id;
                    $history[$key]['operation'] = 'Выплата комиссии';
                    $history[$key]['comment'] = "Выплата за купоны. " . $request->validated()['comment_investor'] . "";

                }
                foreach ($history as $item){
                    History::create($item);
                }
                foreach ($as_id as $item){
                    $this->notification(AutoSchool::where('id', $item)->first()->director_id, "Выплата за купоны. " . $request->validated()['comment_investor'] . "");
                }
                $this->notification(Auth::user()->id, "Выплата за купоны. " . $request->validated()['comment_investor'] . ". В количестве - ". count($coupons) ."");

            });


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
        $this->notification(Auth::user()->id, "Было ануллировано купоны, в количестве - " . count($request->get('id')) . ".");
        return response()->json(['status' => 1], '201');
    }

    /**
     * @param CanceledCoupon $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(CanceledCoupon $request)
    {
        Coupon::whereIn('id', $request->get('id'))->delete();
        $this->notification(Auth::user()->id, "Было удалено купоны, в количестве - " . count($request->get('id')) . ".");

        return response()->json([], '201');
    }
}
