<?php

namespace App\Http\Controllers\Site;

use App\Models\Location\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

/**
 * Class PriceController
 * @package App\Http\Controllers\Site
 */
class PriceController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function getPrice(Request $request)
    {
        $v = Validator::make($request->all(), [
            'city_id' => 'required|exists:cities,id'
        ]);

        if (count($v->errors())) {
            return response()->json(['status' => 0], 400);
        }

        $city = City::find($request->input('city_id'));

        return response()->json(['price' => $city->price], 200);
    }
}
