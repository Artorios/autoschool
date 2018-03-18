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
use App\Models\Location\PriceCity;
use App\Models\User\UserLesson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

Route::group(['prefix' => 'account', 'namespace' => 'Account', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('account.main');
    })->name('user.account');

    Route::get('/profile', 'AccountController@profile');
    Route::post('/profile/change', 'AccountController@changePassword');

    Route::get('/get-count-lesson', function () {
        $user = Auth::user();

        $count = UserLesson::where('user_id', $user->id)->select(['user_id', 'lesson_id'])->groupBy(['user_id', 'lesson_id'])->get()->toArray();

        return response()->json(['count' => count($count)], 200);
    });

    Route::get('/get-current-lesson', 'LessonController@getCurrentLesson');
    Route::get('/get-lessons', 'LessonController@getLessonsSlider');

    Route::group(['prefix' => 'statistic'], function () {
        Route::get('/', 'StatisticController@index')->name('user.statistic');
    });

    Route::get('/statistic/errors', function () {
        return view('account.statistic.error-check');
    })->name('user.statistic.error');

    Route::get('/notifications', function () {
        return view('account.notify.index');
    })->name('user.notify');

    Route::group(['prefix' => 'finance'], function () {
        Route::get('/', function () {
            return view('account.finance.index');
        })->name('user.finance');
    });

    Route::group(['prefix' => 'exams'], function () {
        Route::get('/', function () {
            return view('account.exams.index');
        })->name('user.exams');
    });

    Route::get('/lessons', 'LessonController@index')->name('user.lessons');
    Route::get('/get-count-lessons', 'LessonController@getCountLesson');

    Route::group(['prefix' => 'lessons'], function () {
        Route::get('/exam/banned', function () {
            return view('account.lessons.banned');
        });

        Route::get('/{lesson}', 'LessonController@show')->name('user.lessons.demo');

        /*
         * Other training for lesson
         */
        Route::get('/training/{lesson}', 'UserLessonController@training')->middleware('training');
        Route::get('/exam/{lesson}', 'UserLessonController@getExam')->middleware(['training', 'exam']);
        Route::get('/group-exam/{lesson}', 'UserLessonController@getGroupExam')->middleware(['training', 'exam', 'group-exam']);

        Route::post('/training/{training}/check', 'UserLessonController@checkAnswerTraining');
        Route::post('/training/{training}/send-answer', 'UserLessonController@checkAnswerExam');
        Route::post('/training/{training}/check-training', 'UserLessonController@checkTraining');
        Route::post('/training/{training}/check-exam', 'UserLessonController@checkExam');
        Route::post('/training/{training}/check-group-exam', 'UserLessonController@checkGroupExam');

        Route::get('/analysis/{training}', 'LessonController@analysis');

        Route::post('/video', 'LessonController@videoTimeSave')->name('user.lessons.saveView');
        Route::post('/video/ended', 'LessonController@endView')->name('user.lessons.endView');
    });

    Route::group(['prefix' => 'tickets'], function () {
        Route::get('/', 'TicketsController@index')->name('account.tickets');
        Route::post('/set-show-comments', 'TicketsController@setShowAnswer');
        Route::post('/{ticket}/check', 'TicketsController@checkAnswer');
        Route::post('/{ticket}/check-ticket', 'TicketsController@checkTicket');
        Route::get('/{ticket}', 'TicketsController@single');
    });

});

Route::get('api/lessons', 'Api\LessonController@index');


Route::post('get-price', 'Site\PriceController@getPrice');
Route::get('/schools', 'Site\SchoolsController@getSchools');
Route::get('/schools/{city_id}', 'Site\SchoolsController@getSchools');

require __DIR__ . '/admin/web.php';
