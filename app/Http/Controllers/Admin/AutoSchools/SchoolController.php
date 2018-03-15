<?php

namespace App\Http\Controllers\Admin\AutoSchools;

use App\Models\Training\School\AutoSchool;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Psy\Exception\ErrorException;

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
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0, 'errors' => $validator->errors()], 400);
        }

        try {
            $school = AutoSchool::create($request->only(['title', 'description', 'city_id']));

            $school->contacts()->createMany($request->input('contacts'));

            return response()->json(['status' => 1], 201);
        } catch (ErrorException $e) {
            return response()->json(['status' => 0], 400);
        }
    }
}
