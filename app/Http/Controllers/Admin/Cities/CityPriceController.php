<?php

namespace App\Http\Controllers\Admin\Cities;

use App\Models\Location\City;
use App\Models\Location\District;
use App\Models\Location\PriceCity;
use App\Models\Location\Region;
use ErrorException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/**
 * Class CityPriceController
 * @package App\Http\Controllers\Admin\Cities
 */
class CityPriceController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegions()
    {
        $per_page = 20;
        $regions  = Region::paginate($per_page);

        return view('admin.city.region', compact('regions'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRegions(Request $request)
    {
        $per_page = 20;

        $validator = Validator::make($request->all(), [
           'q' => 'string',
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        $query = Region::query();

        if ($request->input('q')) {
            $q = $request->input('q');

            $query->where('name', 'like', '%' . $q . '%');
        }

        return response()->json(['status' => 1, 'regions' => $query->paginate($per_page)], 200);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createRegion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:regions,name',
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        try {
            Region::create($request->only(['name']));

            return response()->json(['status' => 1], 201);
        } catch (ErrorException $e) {
            return response()->json(['status' => 0], 400);
        }
    }

    /**
     * @param Region  $region
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRegion(Region $region, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|unique:regions,name',
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        try {
            $region->update($request->only(['name']));

            return response()->json(['status' => 1], 202);
        } catch (ErrorException $e) {
            return response()->json(['status' => 0], 400);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCities()
    {
        $per_page = 20;

        $region  = Region::first();
        $regions = Region::all();
        $cities  = City::with('region')->where('regions_id', $region->id)->paginate($per_page);

        return view('admin.city.price', compact('cities', 'region', 'regions'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities(Request $request)
    {
        $per_page = 20;

        $validator = Validator::make($request->all(), [
            'q'         => 'string',
            'region_id' => 'required|exists:regions,id',
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        $query = City::with('region')->where('regions_id', $request->input('region_id'));

        if ($request->input('q')) {
            $q = $request->input('q');

            $query->where('name', 'like', '%' . $q . '%');
        }

        return response()->json(['status' => 1, 'cities' => $query->paginate($per_page)], 200);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required|string|unique:cities,name',
            'regions_id' => 'required|integer|exists:regions,id',
            'price'      => 'integer',
            'show_city'  => Rule::in([1,0]),
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        try {
            City::create($request->only(['name', 'regions_id', 'ru_path', 'price', 'show_city']));

            return response()->json(['status' => 1], 201);
        } catch (ErrorException $e) {
            return response()->json(['status' => 0], 400);
        }
    }

    /**
     * @param City    $city
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCity(City $city, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required|string',
            'regions_id' => 'required|integer|exists:regions,id',
            'price'      => 'integer',
            'show_city'  => Rule::in([1,0]),
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        if ( ! $request->input('ru_path')) {
            $request->request->add(['ru_path' => $request->input('name')]);
        }

        try {
            $city->update($request->only(['name', 'regions_id', 'ru_path', 'price', 'show_city']));

            return response()->json(['status' => 1], 202);
        } catch (ErrorException $e) {
            return response()->json(['status' => 0], 400);
        }
    }

    /**
     * @param City $city
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deleteCity(City $city)
    {
        try {
            $city->delete();

            return response()->json(['status' => 1], 202);
        } catch (ErrorException $e) {
            return response()->json(['status' => 0], 500);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDistricts()
    {
        $per_page  = 20;
        $districts = District::with('city')->paginate($per_page);

        return view('admin.city.district', compact('districts'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDistricts(Request $request)
    {
        $per_page = 20;

        $validator = Validator::make($request->all(), [
            'q' => 'string',
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        $query = District::with('city');

        if ($request->input('q')) {
            $q = $request->input('q');

            $query->where('name', 'like', '%' . $q . '%');
        }

        return response()->json(['status' => 1, 'cities' => $query->paginate($per_page)], 200);
    }
}
