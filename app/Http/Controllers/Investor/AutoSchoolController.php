<?php

namespace App\Http\Controllers\Investor;

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
        $autoSchool = AutoSchool::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'city_id' => $request->get('city'),
            'investor_id' => Auth::id(),
        ]);

        $autoSchool->contacts()->createMany($request->get('contacts'));

        return response()->json(['status' => 1], 201);
    }

    public function show(AutoSchool $autoschool)
    {
        return view('investor.school.update', [
            'school' => $autoschool,
        ]);
    }

    public function update(UpdateAutoSchoolRequest $request, AutoSchool $autoSchool)
    {
        $autoSchool->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'city_id' => $request->get('city'),
        ]);

        $autoSchool->contacts()->sync($request->get('contacts'));

        return response()->json(['status' => 1], 200);
    }
}
