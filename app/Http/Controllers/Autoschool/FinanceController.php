<?php

namespace App\Http\Controllers\Autoschool;

use App\Models\Training\School\AutoSchool;
use App\Services\CountersService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    public function index(CountersService $countersService){
        $users = $countersService
            ->getStudentsFromSchool(AutoSchool::where('director_id', Auth::user()->id)
                ->first()->id);
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
