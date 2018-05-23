<?php

namespace App\Http\Controllers\Account;

use App\Models\User\UserLessonTrainingQuestion;
use App\Models\User\UserLessonTraining;
use App\Services\StatisticService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class StatisticController
 * @package App\Http\Controllers\Account
 */
class StatisticController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(UserLessonTrainingQuestion $userLessonTrainingQuestion, StatisticService $statisticService)
    {
        $user    = Auth::user();
        $lessons = $user->lessons->unique('lesson_num');
        $lessons = $lessons->toArray();

        if (count($lessons)) {
            return view('account.statistic.index',
                $statisticService->progress($user, $lessons, $userLessonTrainingQuestion));
        }
        return view('account.statistic.index');
    }
}
