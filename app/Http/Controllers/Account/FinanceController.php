<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Training\School\AutoSchool;
use App\Models\User\Contract;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Session};

class FinanceController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();



        if(!$user->contract){
            $contract = Contract::create([
                'name' => generateContractNumber($user),
                'user_id' => $user->id
            ]);
        }
        $contract = [
            'name' => $user->contract->name.$user->id.'-'.$user->contract->id.'-'.$user->city->id,
            'date' => $user->created_at->format('d-m-Y'),
            'price' => $user->city->price,
            'amount' => $user->city->price

        ];
        $school_id = $request->session()->get('school-finance');
        if(!empty($school_id)){
            $school = AutoSchool::where('id',$school_id)->with('city')->get();
        }
        else{
            $school = [];
        }
        return view('account.finance.index', compact('user','contract','school'));
    }
    public function getVariants(Request $request)
    {
        $SelectedType = $request->input('variant');
        $user = Auth::user();
        $data = $request->all();
        if($SelectedType == "typeA"){
            return view('account.finance.bankсard', compact('data', 'user'));
        }elseif ($SelectedType == "typeC"){
            return view('account.finance.coupon', compact('data'));
        }elseif ($SelectedType == "typeB"){
            return view('account.finance.transfer', compact('data'));
        }
    }

    public function choiceAutoSchool(Request $request){

        $itempost = $request->only('school');
        if(!empty($itempost['school'])){
            Session::put('school-finance', $itempost['school']);
        }


        return response()->json([], 201);

    }

}