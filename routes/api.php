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
Route::get('/search', 'HomeController@search');

Route::group(['prefix' => 'address'], function () {
    Route::post('/get-regions', 'AddressController@regions');
    Route::post('/get-cities', 'AddressController@cities');
    Route::get('/get-cities-api/{id}', 'AddressController@citiesApi');
    Route::get('/get-regions-api', 'AddressController@regionsApi');
});

Route::post('/get-prices', 'AddressController@prices');
Route::group(['namespace' => 'Admin'], function () {

    Route::get('/get-investors-api/{region}', 'AdminController@getInvestorsApi');
    Route::get('/get-directors-api', 'AdminController@getDirectorsApi');
    Route::post('/admin/school-info', 'AdminController@getSchoolData');
    Route::get('/admin/search-user', 'AdminController@searchUser');
    Route::get('/get-autoschool-api', 'AdminController@getAutoSchoolApi');
    Route::get('/get-schoolgroup-api/{id}', 'AdminController@getSchoolGroupApi');
    Route::get('/get-school/{id}', 'AdminController@getSchool');

});

Route::group(['namespace' => 'Autoschool'], function () {

    Route::get('/groups-api/{id}', 'AutoschoolController@groupsApi');
    Route::get('/students-api/{id}', 'AutoschoolController@studentsApi');


});

