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
    });
    Route::view('/finance', 'investor.finance.index')->name('finance.index');
    Route::view('/history', 'investor.history.index')->name('history.index');
    Route::view('/school', 'investor.school.index')->name('school.index');
    Route::view('/template-pass', 'investor.template-pass')->name('template-pass');
    Route::view('/template-pass-2', 'investor.template-pass-2')->name('template-pass-2');
});
