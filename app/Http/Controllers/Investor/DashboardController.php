<?php

namespace App\Http\Controllers\Investor;

use App\Http\Requests\Investor\FeePay;
use App\Models\Training\School\{AutoSchool, SchoolFee};
use App\Models\User\History;
use App\Repositories\AutoSchoolRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Auth , DB};
/**
 * Class DashboardController
 * @package App\Http\Controllers\Investor
 */
class DashboardController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $schools = AutoSchool::where('investor_id', Auth::user()->id)->with('city')->get();

        return view('investor.index', compact('schools'));
    }


    public function feePay(FeePay $feePay){
        $item = $feePay->validated();
        $item['investor_id'] = Auth::user()->id;
        $history['investor_id'] = Auth::user()->id;
        $history['auto_school_id'] = $item['auto_school_id'];
        $history['operation'] = 'Выплата комиссии';
        $history['comment'] = $item['comment'].'. Выплачено: '.$item['summ'].'р.';
        DB::transaction(function () use ($item, $history) {

            SchoolFee::create($item);
            History::create($history);


        });
        return response()->json([],'201');
    }
}
