<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Location\City;
use App\Models\Location\PriceCity;
use App\Models\User\UserLesson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

Route::group(['prefix' => 'autoschool', 'namespace' => 'Autoschool', 'middleware' => ['auth', 'autoschool']], function (){

    Route::get('/', 'AutoschoolController@index')->name('autoschool.index');

    Route::get('/filials', 'FilialController@index')->name('autoschool.filials');
    Route::get('/filials/{id}', 'FilialController@show');
    Route::post('/filials/create', 'FilialController@createFilial');
    Route::post('/groups/create', 'FilialController@createGroup');


    Route::get('/coupons', function () {
        return view('autoschool.coupons.index');
    })->name('autoschool.coupons');

    Route::get('/finance', function () {
        return view('autoschool.index.index');
    })->name('autoschool.finance');

    Route::get('/history', function () {
        return view('autoschool.index.index');
    })->name('autoschool.history');

    Route::get('/profile-edit', 'AutoschoolController@editPage')->name('autoschool.edit');


    Route::get('/notifications', 'NotificationController@getPageNew')->name('autoschool.notify');
    Route::get('/notifications-all', 'NotificationController@getPageAll')->name('autoschool.notify.all');






    Route::post('/get-count-main-groups', 'AutoschoolController@getCountMain');



    Route::view('faq', 'autoschool.faq')->name('faq');

});

?>