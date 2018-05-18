<?php

namespace App\Http\Controllers\Investor;

use DB;
use Auth;
use App\Http\Controllers\Controller;
use App\Models\Training\School\AutoSchool;
use App\Http\Requests\Investor\StoreAutoSchoolRequest;
use App\Http\Requests\Investor\UpdateAutoSchoolRequest;

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
        return view('investor.school.update', [
            'school' => $autoschool,
        ]);
    }

    public function update(UpdateAutoSchoolRequest $request, AutoSchool $autoSchool)
    {
        $autoSchool->update($request->validated());

        $autoSchool->contacts()->sync($request->get('contacts'));

        return redirect()->route('investor.school.show', ['autoschool' => $autoSchool->id]);
    }
}
