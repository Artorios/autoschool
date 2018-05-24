<?php

namespace App\Http\Controllers\Investor;

use App\Models\Finance\Order;
use App\Transformers\FinanceTransformer;
use Auth;
use App\Http\Controllers\Controller;
use App\Models\Training\School\AutoSchool;

class FinanceController extends Controller
{
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

    public function list()
    {
        $autochools = AutoSchool::where('investor_id', Auth::id())
            ->with('autoschoolGroups.users')
            ->get()
            ->transform(function ($item) {
                $item->users = $item->autoschoolGroups
                    ->pluck('users')
                    ->collapse();
                return $item;
            });
        return fractal($autochools, new FinanceTransformer());
    }
}