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


Route::group(['prefix' => 'autoschool', 'namespace' => 'Autoschool', 'middleware' => ['auth', 'autoschool']], function () {
    Route::get('/', 'AutoschoolController@index')->name('autoschool.index');

    Route::group(['prefix' => 'filials'], function () {
        Route::get('/', 'FilialController@index')->name('autoschool.filials');
        Route::get('{id}', 'FilialController@show');
        Route::post('create', 'FilialController@createFilial');
        Route::group(['prefix' => 'groups'], function () {
            Route::get('{id}', 'FilialController@showStudents');
            Route::post('create', 'FilialController@createGroup');
        });
    });

    Route::get('achievement', 'AchievementController')->name('autoschool.achievement');

    Route::get('results', 'ResultController')->name('autoschool.results');

    Route::get('coupons', 'CouponController')->name('autoschool.coupons');

    Route::get('finances', 'FinanceController')->name('autoschool.finance');

    Route::get('histories', 'HistoryController')->name('autoschool.history');

    Route::get('profile-edit', 'AutoschoolController@editPage')->name('autoschool.edit');

    Route::get('notifications', 'NotificationController@getPageNew')->name('autoschool.notify');
    Route::get('notifications-all', 'NotificationController@getPageAll')->name('autoschool.notify.all');

    Route::post('get-count-main-groups', 'AutoschoolController@getCountMain');

    Route::view('faq', 'autoschool.faq')->name('faq'); //TODO rename 'autoschool.faq' need
});
