<?php

namespace App\Http\Controllers\Autoschool;

use App\Models\Finance\Order;
use App\Models\Training\School\AutoSchool;
use App\Models\Training\School\AutoSchoolFilial;
use App\Models\Training\School\AutoSchoolGroup;
use App\Models\User\User;
use App\Services\CountersService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FinanceController extends Controller
{
    public function index(){
        $users = User::all(); //todo
        return view('autoschool.finance.index', compact('users'));
    }

    public function getCountMain(CountersService $countersService)
    {
        return response()->json([
            'counts' => $countersService->getCountStudentsInAutoSchool(),
            'income' => $countersService->getSumIncome(),
            'coupons' => $countersService->getCountUserPaymentByCupon(),
            'card' => $countersService->getCountUserPaymentByCard(),
        ]);
    }
}
