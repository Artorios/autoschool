<?php

Route::group([
    'prefix' => 'investor',
    'namespace' => 'Investor',
    'as' => 'investor.',
    'middleware' => 'investor',
], function () {
    Route::view('/', 'investor.index')->name('index');
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', 'ProfileController@show')->name('profile.index');
        Route::put('edit', 'ProfileController@update')->name('profile.edit');
        Route::put('password/edit', 'ProfileController@update')->name('profile.password.edit');
    });
    Route::view('/finance', 'investor.finance.index')->name('finance.index');
    Route::view('/history', 'investor.history.index')->name('history.index');
    Route::view('/coupons', 'investor.coupons.index')->name('coupons.index');
    Route::view('/coupons/add', 'investor.coupons.generate_coupon')->name('coupons.add');
});
