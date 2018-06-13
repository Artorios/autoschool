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
    Route::get('/users/{role}', 'UserActions\UserController@listUsersRole');
    Route::get('/students', 'UserActions\UserController@listStudents')->name('admin.students');
    Route::post('/students/get-list-students', 'UserActions\UserController@getListStudents');
    Route::put('/user/edit-user/{user}', 'UserActions\UserController@edit');
    Route::post('/user/pay-user/{user}', 'UserActions\UserController@pay');
    Route::post('/user/create', 'UserActions\UserController@create');

    Route::group(['prefix' => 'schools', 'namespace' => 'AutoSchools'], function () {
        Route::get('/', 'SchoolController@listSchools')->name('admin.schools.list');
        Route::post('/create', 'SchoolController@create')->name('admin.schools.create');
        Route::post('/update/{id}', 'SchoolController@update')->name('admin.schools.update');
    });

    Route::group(['prefix' => 'regions', 'namespace' => 'Cities'], function () {
        Route::get('/', 'CityPriceController@showRegions')->name('admin.regions.list');
        Route::post('/', 'CityPriceController@getRegions');
        Route::post('/create', 'CityPriceController@createRegion')->name('admin.regions.create');
        Route::put('/update/{region}', 'CityPriceController@updateRegion')->name('admin.regions.update');
    });

    Route::group(['prefix' => 'cities', 'namespace' => 'Cities'], function () {
        Route::get('/', 'CityPriceController@showCities')->name('admin.cities.list');
        Route::post('/', 'CityPriceController@getCities');
        Route::delete('/{city}', 'CityPriceController@deleteCity')->name('admin.cities.delete');
        Route::post('/create', 'CityPriceController@createCity')->name('admin.cities.create');
        Route::put('/update/{city}', 'CityPriceController@updateCity')->name('admin.cities.update');
    });

    Route::group(['prefix' => 'districts', 'namespace' => 'Cities'], function () {
        Route::get('/', 'CityPriceController@showDistricts')->name('admin.districts.list');
        Route::post('/', 'CityPriceController@getDistricts');
    });

    Route::group(['prefix' => 'lessons', 'namespace' => 'Lessons'], function () {
        Route::get('/', 'LessonsController@indexAll')->name('admin.lessons.list');
        Route::get('/list/{license}', 'LessonsController@index');
        Route::get('/{lesson}', 'LessonsController@single')->name('admin.lessons.view');
        Route::post('/create', 'LessonsController@create')->name('admin.lessons.create');
        Route::put('/{lesson}', 'LessonsController@editLesson')->name('admin.lessons.update');
        Route::delete('/{lesson}', 'LessonsController@delete')->name('admin.lessons.delete');
        Route::post('/{lesson}/get-questions', 'LessonsController@getQuestions')->name('admin.lessons.question.view');
        Route::post('/{lesson}/change-question', 'LessonsController@changeQuestion')->name('admin.lessons.question.update');
        Route::post('/load-video', 'LessonsController@loadVideo')->name('admin.lessons.video.upload');
        Route::delete('/delete-video/{video}', 'LessonsController@delVideo')->name('admin.lessons.video.update');
        Route::post('/youtube-video/{video}', 'LessonsController@youtube')->name('admin.lessons.video.youtube');
    });

    Route::group(['prefix' => 'questions', 'namespace' => 'Questions'], function () {
        Route::get('/', 'QuestionsController@index')->name('admin.questions.list');
        Route::get('/ticket/{ticket_num}', 'QuestionsController@single');
        Route::get('/question/{question}', 'QuestionsController@singleQuestion');
        Route::patch('/question/{question}', 'QuestionsController@editQuestion');
        Route::patch('/answer/{question}', 'QuestionsController@editAnswers');
        Route::post('/', 'QuestionsController@getQuestions');
        Route::post('/create', 'QuestionsController@create');
        Route::post('/load-image', 'QuestionsController@loadImage');
        Route::delete('/{question}', 'QuestionsController@delete')->name('admin.questions.delete');
    });

    Route::group(['prefix' => 'lessons-settings', 'namespace' => 'Settings'], function () {
        Route::get('/', 'LessonsSettingsController@index')->name('admin.lessons.settings');
        Route::put('/{lessonsSettings}', 'LessonsSettingsController@changeSetting');
    });

    //Route::post('/city/create', 'Cities\CityPriceController@create');
    //Route::put('/city/update/{city}', 'Cities\CityPriceController@update');
});
