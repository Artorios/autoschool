<?php

Route::middleware('guest')->get('/admin/login', function () {
    return view('admin.auth');
})->name('login');

Route::post('/admin/login', 'Auth\LoginController@auth');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin'], 'namespace' => 'Admin'], function () {
    Route::get('/', function () {
        return view('admin.index.index');
    })->name('admin.index');

    Route::get('/users', 'UserActions\UserController@listUsers')->name('admin.users');
    Route::put('/user/edit-user/{user}', 'UserActions\UserController@edit');
    Route::post('/user/create', 'UserActions\UserController@create');

    Route::group(['prefix' => 'schools', 'namespace' => 'AutoSchools'], function () {
        Route::get('/', 'SchoolController@listSchools');
        Route::post('/create', 'SchoolController@create');
    });

    Route::group(['prefix' => 'regions', 'namespace' => 'Cities'], function () {
        Route::get('/', 'CityPriceController@showRegions');
        Route::post('/', 'CityPriceController@getRegions');
        Route::post('/create', 'CityPriceController@createRegion');
        Route::put('/update/{region}', 'CityPriceController@updateRegion');
    });

    Route::group(['prefix' => 'cities', 'namespace' => 'Cities'], function () {
        Route::get('/', 'CityPriceController@showCities');
        Route::post('/', 'CityPriceController@getCities');
        Route::delete('/{city}', 'CityPriceController@deleteCity');
        Route::post('/create', 'CityPriceController@createCity');
        Route::put('/update/{city}', 'CityPriceController@updateCity');
    });

    Route::group(['prefix' => 'districts', 'namespace' => 'Cities'], function () {
        Route::get('/', 'CityPriceController@showDistricts');
        Route::post('/', 'CityPriceController@getDistricts');
    });

    Route::group(['prefix' => 'lessons', 'namespace' => 'Lessons'], function () {
        Route::get('/', 'LessonsController@index');
        Route::get('/{lesson}', 'LessonsController@single');
        Route::put('/{lesson}', 'LessonsController@editLesson');
        Route::delete('/{lesson}', 'LessonsController@delete');
        Route::post('/{lesson}/change-question', 'LessonsController@changeQuestion');
        Route::post('/load-video', 'LessonsController@loadVideo');
        Route::delete('/delete-video/{video}', 'LessonsController@delVideo');
        Route::post('/create', 'LessonsController@create');
        Route::post('/{lesson}/get-questions', 'LessonsController@getQuestions');
    });

    Route::group(['prefix' => 'questions', 'namespace' => 'Questions'], function () {
        Route::get('/', 'QuestionsController@index');
        Route::get('/ticket/{ticket_num}', 'QuestionsController@single');
        Route::get('/question/{question}', 'QuestionsController@singleQuestion');
        Route::patch('/question/{question}', 'QuestionsController@editQuestion');
        Route::patch('/answer/{question}', 'QuestionsController@editAnswers');
        Route::post('/', 'QuestionsController@getQuestions');
        Route::post('/create', 'QuestionsController@create');
        Route::post('/load-image', 'QuestionsController@loadImage');
        Route::delete('/{question}', 'QuestionsController@delete');
    });

    Route::group(['prefix' => 'lessons-settings', 'namespace' => 'Settings'], function () {
        Route::get('/', 'LessonsSettingsController@index');
        Route::put('/{lessonsSettings}', 'LessonsSettingsController@changeSetting');
    });

    //Route::post('/city/create', 'Cities\CityPriceController@create');
    //Route::put('/city/update/{city}', 'Cities\CityPriceController@update');
});
