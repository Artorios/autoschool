<?php

use App\Models\Setting;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/settings-all', function () {
   return response()->json(['settings' => Setting::all()], 200);
});





Route::get('/get-region-prices', 'HomeController@getRegionPrices');
Route::post('/test-kassa', 'HomeController@testKassa');

Route::group(['prefix' => 'address'], function () {
    Route::post('/get-regions', 'AddressController@regions');
    Route::post('/get-cities', 'AddressController@cities');
    Route::get('/get-cities-api/{id}', 'AddressController@citiesApi');
    Route::get('/get-regions-api', 'AddressController@regionsApi');
});

Route::post('/get-prices', 'AddressController@prices');
