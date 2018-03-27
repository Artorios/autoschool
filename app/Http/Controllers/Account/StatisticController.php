<?php

namespace App\Http\Controllers\Account;

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
    public function index()
    {
        $user    = Auth::user();
        $lessons = $user->lessons->unique('lesson_num');
        $lessons = $lessons->toArray();

         if (count($lessons)) {
             $returnLessons = [];

             foreach ($lessons as $key => $lesson) {
                 $returnLessons[$key] = $lesson;
                 $user_video          = $user->lessonsVideos()->where('lesson_id', $returnLessons[$key]['id'])->orderBy('id', 'DESC')->first();
                 $last_train          = $user->lessonsTrainings()->where(['lesson_id' => $returnLessons[$key]['id'], 'type' => 'training'])->where('status', '!=', null)->orderBy('id', 'DESC')->first();
                 $last_exam           = $user->lessonsTrainings()->where(['lesson_id' => $returnLessons[$key]['id'], 'type' => 'exam'])->where('status', '!=', null)->orderBy('id', 'DESC')->first();

                 if ($user_video && $user_video->pivot->viewed) {
                     $returnLessons[$key]['viewed'] = 1;
                 }

                 if ($last_train && $last_train->status) {
                     $returnLessons[$key]['last_training']     = $last_train->status;
                     $returnLessons[$key]['right_quest_train'] = $last_train->questions()->where('correct', 1)->count();
                     $returnLessons[$key]['all_quest_train']   = $last_train->questions()->count();
                 }

                 if ($last_exam && $last_exam->status) {
                     $returnLessons[$key]['last_exam']        = $last_exam->status;
                     $returnLessons[$key]['right_quest_exam'] = $last_exam->questions()->where('correct', 1)->count();
                     $returnLessons[$key]['all_quest_exam']   = $last_exam->questions()->count();
                 }
             }
        }

        return view('account.statistic.index', compact('returnLessons'));
    }
}
