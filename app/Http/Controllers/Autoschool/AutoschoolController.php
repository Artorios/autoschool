<?php

namespace App\Http\Controllers\Autoschool;

use App\Http\Requests\LogoRequest;
use App\Models\Finance\Coupon;
use App\Models\Training\School\{
    AutoSchoolGroup, AutoSchool
};
use App\Models\User\User;
use App\Http\Controllers\Controller;
use App\Services\CountersService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


/**
 * Class AutoschoolController
 * @package App\Http\Controllers\Autoschool
 */
class AutoschoolController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $filials = AutoSchool::select('id')->where('director_id', Auth::user()->id)->get()->toArray();

        $groups_id = array_map(function ($filial) {
            return $filial['id'];
        }, $filials);

        $groups = AutoSchoolGroup::whereIn('auto_school_id', $groups_id)->get();

        return view('autoschool.index.index', compact('groups'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPage()
    {
        $info_about_school = AutoSchool::where('director_id', Auth::user()->id)->with('info')->get();
        return view('autoschool.index.edit', compact('info_about_school'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCountMain(CountersService $countersService)
    {
        return response()->json([
            'counts' => $countersService->getCountStudentsInAutoSchool(),
            'coupons' => $countersService->getCountFreeCupon(),
            'income' => $countersService->getCountIncomeAutoSchool()
        ]);
    }

    /**
     * @param  integer $filial_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCountFilials($filial_id)
    {
        $groups = AutoSchoolGroup::where('auto_school_id', $filial_id)->get()->toArray();
        $groups_id = array_map(function ($group) {
            return $group['id'];
        }, $groups);
        $counts = User::all()->whereIn('auto_school_group_id', $groups_id)
            ->whereIn('role', ['user'])
            ->count();
        $coupons = Coupon::whereIn('auto_school_group_id', $groups_id)->where('status', 1)->count();
        $income = Coupon::whereIn('auto_school_group_id', $groups_id)->where('status', 3)->sum('commision_amount');
        return response()->json(['counts' => $counts, 'coupons' => $coupons, 'income' => $income]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveProfileLogo(LogoRequest $request)
    {
        $filial = AutoSchool::where('id', $request->get('filialId'))->first();

        if ($request->hasFile('img')){
            $file = $request->file('img');

            try {
                $file_name = sha1_file($file) . $file->getCTime() . '.' . $file->getClientOriginalExtension();
                Storage::putFileAs('public/school', $file, $file_name);
                if($filial->logo && 'public/school/' . $filial->logo){
                    Storage::delete('public/school/' . $filial->logo);
                }
                $filial->update(['logo' => $file_name]);
                return response()->json(['status' => 1], 201);
            } catch (ErrorException $e) {
                return response()->json(['status' => 0], 402);
            }
        }
    }
}