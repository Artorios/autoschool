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
        Route::get('{id}', 'FilialController@show')->middleware('filial');
        Route::post('create', 'FilialController@createFilial');
        Route::group(['prefix' => 'groups'], function () {
            Route::get('{id}', 'StudentController@index')->middleware('group');
            Route::get('{id}/{student}', 'StudentController@indexStudent')->middleware('group');
            Route::get('{id}/{student}/statistic-test', 'StudentController@statisticsTests')->middleware('group');
            Route::get('{id}/{student}/statistic-exam', 'StudentController@examStatistics')->middleware('group');
            Route::post('create', 'FilialController@createGroup');
        });
    });

    Route::get('achievement', 'AchievementController')->name('autoschool.achievement');


    Route::post('edit-pass', 'AutoschoolController@updatePassword');
    Route::post('edit-notify-settings', 'AutoschoolController@editNotifySettings');

    Route::get('results', 'ResultController')->name('autoschool.results');

    Route::get('coupons', 'CouponController@index')->name('autoschool.coupons');
    Route::post('coupons/sell', 'CouponController@sell');
    Route::post('coupons/comment', 'CouponController@commentDirector');
    Route::post('coupons/canceled', 'CouponController@canceled');

    Route::get('finances', 'FinanceController@index')->name('autoschool.finance');

    Route::get('histories', 'HistoryController')->name('autoschool.history');

    Route::get('add-student', 'StudentController@addStudent')->name('autoschool.add-student');
    Route::post('get-autoschool-group', 'StudentController@getGroupsAutoSchool');
    Route::post('save-new-student', 'StudentController@saveNewStudent')->name('autoschool.save-new-student');
    Route::view('personal', 'autoschool.personal.index')->name('autoschool.personal');

    Route::get('profile-edit', 'AutoschoolController@editPage')->name('autoschool.edit');
    Route::post('profile-logo-edit', 'AutoschoolController@saveProfileLogo');

    Route::get('notifications', 'NotificationController@getPageNew')->name('autoschool.notify');
    Route::get('notifications-all', 'NotificationController@getPageAll')->name('autoschool.notify.all');

    Route::post('get-count-main-groups', 'AutoschoolController@getCountMain');
    Route::post('get-count-main-filials/{filial}', 'AutoschoolController@getCountFilials');
    Route::post('get-count-main-finance', 'FinanceController@getCountMain');
    Route::post('delete-users', 'FinanceController@deleteUser');

    Route::view('faq', 'autoschool.faq')->name('faq'); //TODO rename 'autoschool.faq' need
});
