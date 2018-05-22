<?php

use App\Models\User\User;
use App\Models\Location\City;
use App\Models\Training\School\AutoSchool;
use App\Models\Finance\Coupon;


function generateContractNumber($user){
    $firstDay = date_create($user->created_at)
        ->modify('first day of this month')
        ->format('Y-m-d');
    $lastDay = date_create($user->created_at)
        ->modify('last day of this month')
        ->format('Y-m-d');
    $userQuantity = User::where('created_at', '>=', $firstDay)
        ->where('created_at', '<=', $lastDay)->count();
    $userNumber = str_pad($userQuantity, 4, "0", STR_PAD_LEFT);
    return "K" . $user->license ? $user->license : '' . "-" . date("m") . date("y") . "-" . $userNumber;
}

function all_sum($user_id){
    $schools = AutoSchool::where('director_id', $user_id)->get()->toArray();
    $schools_id = array_map(function ($school) {
        return $school['id'];
    }, $schools);
    $summ = Coupon::whereIn('auto_school_id', $schools_id)->where('status', 3)->sum('payment_amount');

    return $summ;

}




