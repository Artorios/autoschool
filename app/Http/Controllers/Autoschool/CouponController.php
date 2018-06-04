<?php

namespace App\Http\Controllers\Autoschool;

use App\Http\Controllers\Controller;
use App\Http\Requests\{CanceledCoupon, SellCoupon};
use App\Models\Finance\Coupon;
use App\Models\Training\School\AutoSchool;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{

    public function index()
    {
        $schools = AutoSchool::select('id')->where('director_id', Auth::user(){'id'} )->get()->toArray();
        $school_id = array_map(function ($school) {
            return $school['id'];
        }, $schools);
        $coupons = Coupon::whereIn('status', ['1','2','3'])->whereIn('auto_school_id',$school_id)->orderBy('generation_date', 'asc')->with('user')->with('school')->with('group')->get();
        return view('autoschool.coupons.index', compact('coupons'));
    }


    public function sell(SellCoupon $coupon)
    {
        $count = Coupon::whereIn('id',$coupon->validated()['id'])->where('status' , 1)->count();
        if($count != 0){
            if(!empty($coupon->validated()['student_id'])){
                Coupon::whereIn('id',$coupon->validated()['id'])->where('status' , 1)->update([
                    'status' => 2,
                    'comment_director' => $coupon->validated()['comment_director'],
                    'student_id' => $coupon->validated()['student_id'],
                    'auto_school_group_id' => $coupon->validated()['auto_school_group_id'],
                    'sale_date' => Carbon::now()
                ]);
            }
            else{
                Coupon::whereIn('id',$coupon->validated()['id'])->where('status' , 1)->update([
                    'status' => 2,
                    'comment_director' => $coupon->validated()['comment_director'],
                    'auto_school_group_id' => $coupon->validated()['auto_school_group_id'],
                    'sale_date' => Carbon::now()
                ]);
            }

        }

        //
        return response()->json(['count' => $count],'201');
    }

    public function commentDirector(SellCoupon $coupon){
        $count = Coupon::whereIn('id',$coupon->validated()['id'])->where('status' , 3)->count();
        if($count != 0){
            Coupon::whereIn('id',$coupon->validated()['id'])->where('status' , 3)->update([
                'comment_coupon' => $coupon->validated()['comment_director']
            ]);
        }


        //
        return response()->json(['countTop' => $count],'201');
    }

    public function canceled(CanceledCoupon $coupon){
        Coupon::whereIn('id',$coupon->validated()['id'])->update([
            'status' => 4
        ]);
        return response()->json(['status' => 1],'201');

    }

}
