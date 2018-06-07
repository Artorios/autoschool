<?php

namespace App\Http\Controllers\Investor;

use DB;
use Auth;
use App\Http\Controllers\Controller;
use App\Models\Training\School\AutoSchool;
use App\Http\Requests\Investor\StoreAutoSchoolRequest;
use App\Http\Requests\Investor\UpdateAutoSchoolRequest;
use Illuminate\Http\Request;

class AutoSchoolController extends Controller
{
    public function index()
    {
        return view('investor.school.index', [
            'schools' => AutoSchool::where('investor_id', Auth::id())
                ->with('city', 'contacts')
                ->get(),
        ]);
    }

    public function create()
    {
        return view('investor.school.create');
    }

    public function store(StoreAutoSchoolRequest $request)
    {
        DB::beginTransaction();

        $autoSchool = AutoSchool::create($request->validated());

        $autoSchool->contacts()->createMany($request->get('contacts'));

        DB::commitTransaction();

        return redirect()->route('investor.school.index');
    }

    public function show(AutoSchool $autoschool)
    {
        return view('investor.school.update', compact('autoschool'));
    }

    public function update(UpdateAutoSchoolRequest $request, AutoSchool $autoSchool)
    {
        $autoSchool->update($request->validated());

        $autoSchool->contacts()->sync($request->get('contacts'));

        return redirect()->route('investor.school.show', ['autoschool' => $autoSchool->id]);
    }

    public function getInfoAboutAutoschool(Request $request)
    {
        return response()->json(['data' => AutoSchool::leftjoin('auto_school_info', 'auto_schools.id', '=', 'auto_school_info.auto_school_id')
            ->where('auto_schools.id', $request->autoschool)
            ->get()
            ->first()
        ], 201);
    }

    public function changeInfoAboutAutoSchool(Request $request)
    {
        try {
            AutoSchool::where('id', $request->id)->update([
                'commission' => $request->commission
            ]);
            return response()->json(['status' => 1], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 0], 400);
        }
    }
}
