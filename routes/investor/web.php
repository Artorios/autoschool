<?php

Route::group([
    'prefix' => 'investor',
    'namespace' => 'Investor',
    'as' => 'investor.',
    'middleware' => 'investor',
], function () {

    Route::get('/', 'DashboardController@show')->name('index');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', 'ProfileController@show')->name('profile.index');
        Route::put('edit', 'ProfileController@update')->name('profile.edit');
        Route::put('password/edit', 'PasswordController')->name('profile.password.edit');
    });

    Route::group(['prefix' => 'notifications'], function () {
        Route::get('/', 'NotificationController@index')->name('notifications.index');
        Route::put('{notification}', 'NotificationController@update')->name('notification.read');
    });

    Route::group(['prefix' => 'coupons'], function () {
        Route::get('/', 'CouponsController@index')->name('coupons.index');
        Route::get('create', 'CouponsController@create')->name('coupons.create');
        Route::post('create', 'CouponsController@store')->name('coupons.store');
        Route::post('sell', 'CouponsController@sell');
        Route::post('comment', 'CouponsController@comment');
        Route::post('canceled', 'CouponsController@canceled');
    });

    Route::group(['prefix' => 'school'], function () {
        Route::get('/', 'AutoSchoolController@index')->name('school.index');
        Route::get('create', 'AutoSchoolController@create')->name('school.create');
        Route::post('create', 'AutoSchoolController@store')->name('school.store');
        Route::get('{autoschool}', 'AutoSchoolController@show')
            ->name('school.show')
            ->middleware('can:investor-autoschool,autoschool');
        Route::post('/get-info-about-school', 'AutoSchoolController@getInfoAboutAutoschool');
        Route::post('/change-info-about-autoschool', 'AutoSchoolController@changeInfoAboutAutoSchool');
        Route::put('{autoschool}', 'AutoSchoolController@update')->name('school.update');
    });

    Route::group(['prefix' => 'finance'], function () {
        Route::get('/', 'FinanceController@index')->name('finance.index');
    });

    Route::view('/history', 'investor.history.index')->name('history.index');
    Route::get('/history/list', 'HistoryController@all');

    Route::get('/coupons/list', 'CouponsController@all');
    Route::get('/finance/list', 'FinanceController@all');

    Route::view('/template-pass', 'investor.template-pass')->name('template-pass');
    Route::view('/template-pass-2', 'investor.template-pass-2')->name('template-pass-2');

});
