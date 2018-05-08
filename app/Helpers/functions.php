<?php

use App\Models\User\User;
use App\Models\Location\City;
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



