<?php

namespace App\Http\Controllers;

use App\Models\Location\City;
use App\Models\Location\PriceCity;
use App\Models\Location\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class AddressController
 * @package App\Http\Controllers
 */
class AddressController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function regions()
    {
        return response()->json(['regions' => Region::all()->toArray()], 200);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function cities(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'regions_id' => 'integer|exists:regions,id'
        ]);

        if (count($validator->errors())) {
            return response()->json(['errors' => $validator->errors(), 'status' => 0], 400);
        }

        $region_id = $request->input('regions_id');

        $cities = City::query();

        if ($region_id) {
            $cities->where('regions_id', $region_id);
        }

        return response()->json(['cities' => $cities->get()], 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function prices()
    {
        return response()->json(['cities' => PriceCity::with('city')->where('show_city', 1)->get()], 200);
    }

    /**
     * @param Request $request
     * @param         $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function citiesApi(Request $request, $id)
    {
        $q = $request->input('q');

        return response()->json(City::where('regions_id', $id)->where('name', 'like', '%' . $q . '%')->limit(10)->get(), 200);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function regionsApi(Request $request)
    {
        $q = $request->input('q');

        return response()->json(Region::where('name', 'like', '%' . $q . '%')->limit(10)->get(), 200);
    }
}
