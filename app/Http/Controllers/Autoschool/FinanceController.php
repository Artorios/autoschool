<?php

namespace App\Http\Controllers\Autoschool;

use App\Models\Finance\Order;
use App\Models\Training\School\AutoSchool;
use App\Models\Training\School\AutoSchoolFilial;
use App\Models\Training\School\AutoSchoolGroup;
use App\Models\User\User;
use App\Services\MainCountFinanceService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FinanceController extends Controller
{
    public function index(MainCountFinanceService $financeService){
        $data = $financeService->getStudentsInAutoSchool();
        return view('autoschool.finance.index', compact('data'));
    }

    public function getCountMain(MainCountFinanceService $financeService)
    {
        return response()->json([
            'counts' => $financeService->getCountOfStudentInAutoSchool(),
            'income' => $financeService->getSumIncome(),
            'coupons' => $financeService->getCountUserPaymentByCupon(),
            'card' => $financeService->getCountUserPaymentByCard(),
        ]);
    }


}
