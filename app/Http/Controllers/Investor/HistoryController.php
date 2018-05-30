<?php

namespace App\Http\Controllers\Investor;

use App\Models\User\History;
use App\Http\Controllers\Controller;
use App\Http\Requests\Investor\HistoryRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class HistoryController
 * @package App\Http\Controllers\Investor
 */
class HistoryController extends Controller
{

    /**
     * @param HistoryRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(HistoryRequest $request)
    {
        return view('investor.history.index', [
            'histories' => History::where('user_id', Auth::id())
                ->get(),
        ]);
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return History::where('investor_id', Auth::id())->get();
    }
}
