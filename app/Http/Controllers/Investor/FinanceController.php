<?php

namespace App\Http\Controllers\Investor;

use App\Models\Finance\Order;
use App\Services\FinancesInvestorService;
use App\Transformers\FinanceTransformer;
use App\Http\Controllers\Controller;
use App\Models\Training\School\AutoSchool;
use Illuminate\Support\Facades\Auth;

/**
 * Class FinanceController
 * @package App\Http\Controllers\Investor
 */
class FinanceController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {


        return view('investor.finance.index', [
            'students' => AutoSchool::where('investor_id', Auth::id())
                ->with('autoschoolGroups.users')
                ->get()
                ->transform(function ($item) {
                    $item->users = $item->autoschoolGroups
                        ->pluck('users')
                        ->collapse();
                    return $item;
                }),
        ]);
    }

    public function all(FinancesInvestorService $financesInvestorService)
    {
        try {
           if(!empty($financesInvestorService->dataForFinancePage())) {
             return response()->json(['data' => $financesInvestorService->dataForFinancePage()], 201);
           } else {
               throw new \Exception();
           }

        } catch (\Exception $exception) {
            return response()->json(['error' => 1], 422);
        }
    }
}