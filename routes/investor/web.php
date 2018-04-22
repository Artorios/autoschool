<?php

Route::group(['prefix' => 'investor', 'namespace' => 'Investor', 'as' => 'investor.'], function(){
    Route::view('/', 'investor.index')->name('index');
});