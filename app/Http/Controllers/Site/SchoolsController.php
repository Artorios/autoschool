<?php

namespace App\Http\Controllers\Site;

use App\Models\Training\School\AutoSchool;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class SchoolsController
 * @package App\Http\Controllers\Site
 */
class SchoolsController extends Controller
{
    /**
     * @param int $city_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSchools($city_id = 0)
    {
        $schools = AutoSchool::with('city', 'phones', 'addresses');

        if ($city_id) {
            $schools->where('city_id', $city_id);
        }

        return response()->json($schools->get(), 200);
    }
}
