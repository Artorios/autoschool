<?php

namespace App\Http\Controllers\Investor;

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

    /**
     * @return \Spatie\Fractal\Fractal
     */
    public function all()
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