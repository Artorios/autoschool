<?php

Route::group(['prefix' => 'investor', 'namespace' => 'Investor', 'as' => 'investor.'], function(){
    Route::view('/', 'investor.index')->name('index');
    Route::view('/finance', 'investor.finance.index')->name('finance.index');
    Route::view('/history', 'investor.history.index')->name('history.index');
    Route::view('/profile/edit', 'investor.profile.edit')->name('profile.edit');
    Route::view('/coupons', 'investor.coupons.index')->name('coupons.index');
});