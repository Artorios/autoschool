<?php

namespace App\Http\Controllers\Investor;

use App\Transformers\HistoryTransformer;
use Auth;
use App\Models\User\History;
use App\Http\Controllers\Controller;
use App\Http\Requests\Investor\HistoryRequest;

class HistoryController extends Controller
{
    public function index(HistoryRequest $request)
    {
        return view('investor.history.index', [
            'histories' => History::where('user_id', Auth::id())
                ->get(),
        ]);
    }

    public function list()
    {
        return fractal(History::where('investor_id', Auth::id())->get(), new HistoryTransformer())->respond();
    }
}
