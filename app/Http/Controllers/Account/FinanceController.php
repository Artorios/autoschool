<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Training\School\AutoSchool;
use App\Models\User\Contract;
use App\Models\User\{
    User, UserSchool
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth, Session
};

class FinanceController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();


        if (!$user->contract) {
            $contract = Contract::create([
                'name' => generateContractNumber($user),
                'user_id' => $user->id
            ]);
        }
        $contract = [
            'name' => $user->contract->name . $user->id . '-' . $user->contract->id . '-' . $user->city->id,
            'date' => $user->created_at->format('d-m-Y'),
            'price' => $user->city->price,
            'amount' => $user->city->price

        ];
        $userSchool = UserSchool::where('user_id', Auth::user()->id)->first();
        if (!empty($userSchool)) {
            $school = AutoSchool::where('id', $userSchool['school_id'])->with('city')->get();
        } else {
            $school = [];
        }
        return view('account.finance.index', compact('user', 'contract', 'school'));
    }

    public function getVariants(Request $request)
    {
        $SelectedType = $request->input('variant');
        $user = Auth::user();
        $data = $request->all();
        if ($SelectedType == "typeA") {
            return view('account.finance.bankсard', compact('data', 'user'));
        } elseif ($SelectedType == "typeC") {
            return view('account.finance.coupon', compact('data'));
        } elseif ($SelectedType == "typeB") {
            return view('account.finance.transfer', compact('data'));
        }
    }

    public function choiceAutoSchool(Request $request)
    {

        $itempost = $request->only('school');
        $user = Auth::user();
        $school = UserSchool::where('user_id', Auth::user()->id)->first();
        if (!empty($school)) {
            $school->update(['school_id' => $itempost['school']]);
        } else {
            UserSchool::create([
                'user_id' => Auth::user()->id,
                'school_id' => $itempost['school'],
                'status' => '1'
            ]);
            $autoSchool = AutoSchool::find($itempost['school']);
            $this->notification($autoSchool->director_id, "Пользователь $user->name $user->last_name выбрал автошколу $autoSchool->title");

        }


        return response()->json([], 201);

    }

}