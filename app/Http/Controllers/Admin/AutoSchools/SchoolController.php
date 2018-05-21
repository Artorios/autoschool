<?php

namespace App\Http\Controllers\Admin\AutoSchools;

use App\Models\Training\School\{AutoSchool, AutoSchoolContact};
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
        $schools  = AutoSchool::with('contacts')->paginate($per_page);

        return view('admin.school.index', compact('schools'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'            => 'required|string|min:6',
            'description'      => 'required|string|min:6',
            'contacts'         => 'required|array',
            'contacts.*.type'  => ['required', Rule::in(['phone', 'address'])],
            'contacts.*.value' => 'required|string|min:3',
            'city_id'          => 'required|integer|exists:cities,id',
            'director_id'          => 'integer',
            'investor_id'          => 'integer',
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0, 'errors' => $validator->errors()], 400);
        }

        try {
            $school = AutoSchool::create($request->only(['title', 'description', 'city_id','director_id','investor_id']));

            $school->contacts()->createMany($request->input('contacts'));

            return response()->json(['status' => 1], 201);
        } catch (ErrorException $e) {
            return response()->json(['status' => 0], 400);
        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'            => 'required|string|min:6',
            'description'      => 'required|string|min:6',
            'contacts'         => 'required|array',
            'contacts.*.type'  => ['required', Rule::in(['phone', 'address'])],
            'contacts.*.value' => 'required|string|min:3',
            'city_id'          => 'required|integer|exists:cities,id',
            'director_id'          => 'integer',
            'investor_id'          => 'integer',
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0, 'errors' => $validator->errors()], 400);
        }

        DB::transaction(function () use ($request,$id) {

                $school = AutoSchool::where('id', $id)->update($request->only(['title', 'description', 'city_id', 'director_id', 'investor_id']));
                foreach ($request->contacts as $item) {
                    if(!empty($item['id'])) {
                        AutoSchoolContact::where('id', $item['id'])->update(['type' => $item['type'], 'value' => $item['value'], 'auto_school_id' => $id]);
                    }
                    else{
                        AutoSchoolContact::create(['type' => $item['type'], 'value' => $item['value'], 'auto_school_id' => $id]);

                    }
                }
            });
        return response()->json(['status' => $request->contacts[0]], 201);

    }
}
