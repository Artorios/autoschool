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

use App\Models\Location\City;
use App\Models\User\UserLessonVideo;
use Illuminate\Support\Facades\Auth;

Route::get('/', 'HomeController@index');

Route::middleware('guest')->get('/registration', function () {
    $cities = City::where('show_city', 1)->get();

    return view('site.reg', compact('cities'));
})->name('regUser');

Route::middleware('guest')->get('/login', function () {
    return view('site.auth');
})->name('authUser');

Route::middleware('auth')->get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/registration', 'Site\RegistrationController@registration');
Route::post('/login', 'Auth\LoginController@auth');

/*
 * Social authentication
 */
Route::group(['prefix' => 'user', 'namespace' => 'Auth'], function () {
    Route::get('/redirect/{provider}', 'SocialAuthController@redirect');
    Route::get('/callback/{provider}', 'SocialAuthController@callback');
    Route::get('/activation/{token}', 'LoginController@activateUser')->name('user.activate');
    //Route::post('activation/send_mail', 'ActivationController@sendActivationMail')->name('user.activate.send_mail');
});

Route::group(['prefix' => 'account', 'namespace' => 'Account', 'middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('account.main', []);
    })->name('user.account');

    Route::post('/get-group-lessons', 'LessonController@getGroupLessons');

    Route::get('/get-count-lesson', function () {
        $user = Auth::user();

        $count = UserLessonVideo::where('user_id', $user->id)->where('viewed', 1)->get()->count();

        return response()->json(['count' => $count], 200);
    });

    Route::get('/get-current-lesson', 'LessonController@getCurrentLesson');
    Route::get('/get-lessons', 'LessonController@getLessonsSlider');


    Route::group(['prefix' => 'statistic', 'middleware' => ['student']] , function () {
        Route::get('/', 'StatisticController@index')->name('user.statistic');
    });

    Route::get('/statistic/errors', function () {
        return view('account.statistic.error-check');
    })->name('user.statistic.error');

    Route::get('/notifications', 'NotificationController@getPageNew')->name('user.notify');

    Route::get('/notifications-all', 'NotificationController@getPageAll')->name('user.notify.all');

    Route::post('/notify-read', 'NotificationController@notifyRead');

    Route::get('/edit-profile', 'AccountController@editProfile')->name('user.edit');

    Route::post('/edit-profile', 'AccountController@updateProfile');
    Route::post('/edit-pass', 'AccountController@updatePassword');
    Route::post('/edit-notify-settings', 'AccountController@editNotifySettings');
    Route::post('/profile-save-image', 'AccountController@saveProfileImage');

    Route::get('/auth-info-acc', function () {
        $user = Auth::user();
        return response()->json(['user' => $user]);
    });
    Route::group(['prefix' => 'finance'], function () {
        Route::post('get-variants', 'FinanceController@getVariants')->name('account.finance.getvariants');
        Route::post('card-payment', 'OrderController@cardPayment')->name('account.finance.cardpayment');
        Route::post('choice-autoschool', 'FinanceController@choiceAutoSchool');
    });

    Route::get('/get-count-lessons', 'LessonController@getCountLesson');
    Route::get('/get-count-school-exam', 'LessonController@getCountSchoolExam');

    Route::group(['prefix' => 'lessons'], function () {
        Route::get('{lesson}', 'LessonController@show');

        Route::get('/exam/banned', function () {
            return view('account.lessons.banned');
        });

        Route::get('/group/banned', function () {
            return view('account.lessons.group-banned');
        });

        /*
         * Other training for lesson
         */
        Route::get('/training/{lesson}', 'UserLessonController@training')->middleware('training');
        Route::get('/exam/{lesson}', 'UserLessonController@getExam')->middleware(['training', 'exam']);
        Route::get('/group-exam/{lesson}', 'UserLessonController@getGroupExam')->middleware(['training', 'exam', 'group-exam']);

        Route::group(['prefix' => 'training/{training}'], function () {
            Route::post('check', 'UserLessonController@checkAnswerTraining');
            Route::post('send-answer', 'UserLessonController@checkAnswerExam');
            Route::post('check-training', 'UserLessonController@checkTraining');
            Route::post('check-exam', 'UserLessonController@checkExam');
            Route::post('check-group-exam', 'UserLessonController@checkGroupExam');
        });

        Route::get('/analysis/{training}', 'LessonController@analysis');

        Route::post('/video', 'LessonController@videoTimeSave')->name('user.lessons.saveView');
        Route::post('/video/ended', 'LessonController@endView')->name('user.lessons.endView');
    });
    Route::view('faq', 'account.faq')->name('faq');

    Route::group(['prefix' => 'tickets', 'middleware' => ['student']], function () {
        Route::get('/', 'TicketsController@index')->name('account.tickets');
        Route::post('/set-show-comments', 'TicketsController@setShowAnswer');
        Route::post('/{ticket}/check', 'TicketsController@checkAnswer');
        Route::post('/{ticket}/check-ticket', 'TicketsController@checkTicket');
        Route::get('/{ticket}', 'TicketsController@single');
        Route::get('/analysis/{ticket}', 'TicketsController@analysis');
    });
    Route::group(['prefix' => 'exams', 'middleware' => ['student']], function () {
        Route::get('/', 'ExamsController@index')->name('user.exams');
        Route::get('/test', 'ExamsController@testPage');
        Route::get('/analysis/{id}', 'ExamsController@analysis');
        Route::post('/test/{training}/check-exam', 'ExamsController@checkExam');
        Route::post('/test/{training}/send-answer', 'ExamsController@checkAnswerExam');
    });
});

Route::get('/account/finance', 'Account\FinanceController@index')->middleware('auth')->name('user.finance');
Route::get('/account/lessons', 'Account\LessonController@index')->middleware('auth')->name('user.lessons');

Route::post('get-price', 'Site\PriceController@getPrice');
Route::post('cupon-payment', 'Account\OrderController@cuponPayment')->name('account.finance.cuponPayment');
Route::get('/schools', 'Site\SchoolsController@getSchools');
Route::get('/schools/{city_id}', 'Site\SchoolsController@getSchools');

Route::get('/confirm/student/{confirmation_code}', 'Site\SchoolsController@confirmStudent');

Route::get('/students-list', function (){
    return view('autoschool.filials.students_list');
});

require __DIR__ . '/admin/web.php';
require __DIR__ . '/autoschool/web.php';
require __DIR__ . '/investor/web.php';

Route::get('storage/{filename}', 'Autoschool\AutoschoolController@getProfileLogo');

Route::get('/account/lessons/demo/training/{lesson}', 'Account\UserLessonController@training');
Route::get('/account/lessons/demo/{lesson}', 'Account\LessonController@showDemoLesson');
Route::get('/account/lessons/demo/exam/{lesson}', 'Account\UserLessonController@getExam');