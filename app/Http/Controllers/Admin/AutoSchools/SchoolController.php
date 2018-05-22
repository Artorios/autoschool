<?php

namespace App\Http\Controllers\Admin\AutoSchools;

use App\Http\Requests\{CreateAutoSchoolAdmin,UpdateAutoSchoolAdmin};
use App\Http\Requests\UpdateAutoSchoolAdminContacts;
use App\Models\Location\City;
use App\Models\Training\School\{
    AutoSchool, AutoSchoolContact
};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Psy\Exception\ErrorException;
use Illuminate\Support\Facades\DB;

/**
 * Class SchoolController
 * @package App\Http\Controllers\Admin\AutoSchools
 */
class SchoolController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listSchools()
    {
        $per_page = 20;
        $schools = AutoSchool::with('contacts')->paginate($per_page);

        return view('admin.school.index', compact('schools'));
    }

    /**
     * @param CreateAutoSchoolAdmin $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateAutoSchoolAdmin $request)
    {

        DB::transaction(function () use ($request) {
            $school = AutoSchool::create($request->validated());
            $city = City::where('id', $request->validated()['city_id'])->update(['show_city' => 1]);
            $school->contacts()->createMany($request->validated()['contacts']);

        });
        return response()->json(['status' => 1], 201);
    }

    /**
     * @param UpdateAutoSchoolAdmin $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateAutoSchoolAdmin $request, UpdateAutoSchoolAdminContacts $adminContacts, $id)
    {



        DB::transaction(function () use ($request,$adminContacts, $id) {
            $city = AutoSchool::where('id', $id)->firstOrFail()->city_id;
            if ($city != $request->validated()['city_id']) {
                City::where('id', $city)->update(['show_city' => 0]);
                City::where('id', $request->input('city_id'))->update(['show_city' => 1]);
            }
            $school = AutoSchool::where('id', $id)->update($request->validated());
            foreach ($adminContacts->validated()['contacts'] as $item) {
                if (!empty($item['id'])) {
                    AutoSchoolContact::where('id', $item['id'])->update(['type' => $item['type'], 'value' => $item['value'], 'auto_school_id' => $id]);
                } else {
                    AutoSchoolContact::create(['type' => $item['type'], 'value' => $item['value'], 'auto_school_id' => $id]);

                }
            }
        });
        return response()->json(['status' => 1], 202);

    }
}
