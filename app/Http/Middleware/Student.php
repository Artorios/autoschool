<?php

namespace App\Http\Middleware;

use App\Models\User\Coupon;
use App\Models\User\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Student
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $activeByCupon = Coupon::where('student_id', Auth::user()->id)->get()->first();
            $activeByCard = false;
            $activeBytransaction = false;
            $paid = false;

            if($activeByCupon->status == 3 || $activeByCard || $activeBytransaction && $activeByCupon->activated == 1){
                $paid = true;
            }

            return ($paid) ? $next($request) : redirect('account/finance/');
        }catch (\Exception $exception) {
            return redirect('account/finance/');
        }
    }
}
