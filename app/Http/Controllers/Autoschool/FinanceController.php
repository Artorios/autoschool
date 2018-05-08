<?php

namespace App\Http\Controllers\Autoschool;

use App\Models\Training\School\AutoSchool;
use App\Models\User\User;
use App\Services\CountersService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    public function index(CountersService $countersService)
    {
        $users = $countersService
            ->getAllStudentsFromSchool();
        return view('autoschool.finance.index', compact('users'));
    }

    /**
     * @param CountersService $countersService
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCountMain(CountersService $countersService)
    {
        return response()->json([
            'counts' => $countersService->getCountStudentsInAutoSchool(),
            'income' => $countersService->getSumIncome(),
            'coupons' => $countersService->getCountUserPaymentByCupon(),
            'card' => $countersService->getCountUserPaymentByCard(),
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteUser(Request $request)
    {
        try{
            array_map(function($one){
                return User::FindOrFail($one)->delete();
            },$request->input('id'));
            return response()->json(['status' => 1], 201);
        }catch (\Exception $exception){
            return response()->json(['status' => 0], 400);
        }
    }
}
