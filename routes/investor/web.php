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
    Route::view('/finance', 'investor.finance.index')->name('finance.index');
    Route::view('/history', 'investor.history.index')->name('history.index');
    Route::view('/coupons', 'investor.coupons.index')->name('coupons.index');
    Route::view('/coupons/add', 'investor.coupons.generate_coupon')->name('coupons.add');
    Route::view('/school', 'investor.school.index')->name('school.index');
    Route::view('/template-pass', 'investor.template-pass')->name('template-pass');
    Route::view('/template-pass-2', 'investor.template-pass-2')->name('template-pass-2');
});