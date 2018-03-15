<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Models\Training\Lesson\LessonsSettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

/**
 * Class LessonsSettingsController
 * @package App\Http\Controllers\Admin\Settings
 */
class LessonsSettingsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $settings = LessonsSettings::all();

        return view('admin.settings.lessons', compact('settings'));
    }

    /**
     * @param LessonsSettings $lessonsSettings
     * @param Request         $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeSetting(LessonsSettings $lessonsSettings, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required',
        ]);

        if (count($validator->errors())) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $lessonsSettings->value = $request->input('value');

        $lessonsSettings->save();

        return response()->json([], 202);
    }
}
