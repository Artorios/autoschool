<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\User\Contract;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if(!$user->contract){
            $contract = Contract::create([
                'name' => generateContractNumber($user),
                'user_id' => $user->id
            ]);
        }
        return view('account.finance.index', compact('user'));
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
}