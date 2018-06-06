<?php

use App\Models\User\User;
use App\Models\Location\City;
use App\Models\Training\School\{
    AutoSchool, AutoSchoolGroup
};
use App\Models\Finance\{
    Coupon, Order
};


function generateContractNumber($user)
{
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

function all_sum($user_id)
{
    $schools = AutoSchool::where('director_id', $user_id)->get()->toArray();
    $schools_id = array_map(function ($school) {
        return $school['id'];
    }, $schools);
    //Coupons
    $cupons = Coupon::whereIn('auto_school_id', $schools_id)->whereIn('status', [2, 3])->sum('payment_amount');

    //Orders
    $filials = AutoSchool::select('id')->where('director_id', $user_id)->get()->toArray();
    $filials_id = array_map(function ($filial) {
        return $filial['id'];
    }, $filials);
    $groups = AutoSchoolGroup::all()->whereIn('auto_school_id', $filials_id)->toArray();
    $groups_id = array_map(function ($group) {
        return $group['id'];
    }, $groups);
    $users = User::all()->whereIn('auto_school_group_id', $groups_id)->toArray();
    $users_id = array_map(function ($user) {
        return $user['id'];
    }, $users);
    $orders = Order::all()->whereIn('user_id', $users_id)->sum('amount');

    //All Summ
    $summ = $cupons + $orders;
    return $summ;

}

function group_name($id){
    $user = User::find($id);

    return AutoSchoolGroup::find($user->auto_school_group_id)->name;
}




