<?php

namespace App\Http\Controllers\Account;

use App\Models\User\UserLessonTrainingQuestion;
use App\Models\User\UserLessonTraining;
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
    public function index(UserLessonTrainingQuestion $userLessonTrainingQuestion)
    {
        $user    = Auth::user();
        $lessons = $user->lessons->unique('lesson_num');
        $lessons = $lessons->toArray();

         if (count($lessons)) {
             $returnLessons = [];
             $returnResult = [];
             $countTests = [];

             foreach ($lessons as $key => $lesson) {
                 $returnLessons[$key] = $lesson;
                 $user_video          = $user->lessonsVideos()->where('lesson_id', $returnLessons[$key]['id'])->orderBy('id', 'DESC')->first();
                 $last_train          = $user->lessonsTrainings()->where(['lesson_id' => $returnLessons[$key]['id'], 'type' => 'training'])->where('status', '!=', null)->orderBy('id', 'DESC')->first();
                 $last_exam           = $user->lessonsTrainings()->where(['lesson_id' => $returnLessons[$key]['id'], 'type' => 'exam'])->where('status', '!=', null)->orderBy('id', 'DESC')->first();




                 $returnResult[$returnLessons[$key]['id']]['lesson'] = $returnLessons[$key]['id'];
                 $countTests = $user->lessonsTrainings()->where(['lesson_id' => $returnLessons[$key]['id']])->get();
                 $countTests = count($countTests);
                 if(!empty($countTests)){
                     $idLessonTrains = $user->lessonsTrainings()->where(['lesson_id' => $returnLessons[$key]['id']])->get();
                     foreach ($idLessonTrains as $key1 => $idLessonTrain){
                         $returnResult[$returnLessons[$key]['id']]['idLessonTrain'][$key1] = $idLessonTrain;

                         $returnResult[$returnLessons[$key]['id']]['lesson_trainings'][$key1] = UserLessonTraining::find($idLessonTrain['id'])->questions()->get();
                         $questions_all[$idLessonTrain['id']] = count($returnResult[$returnLessons[$key]['id']]['lesson_trainings'][$key1]);

                         $questions_correct[$idLessonTrain['id']] = $userLessonTrainingQuestion->
                                where(['user_lesson_training_id' => $idLessonTrain['id'], 'correct' => 1])->
                                get();
                         $questions_correct[$idLessonTrain['id']] = count($questions_correct[$idLessonTrain['id']]);


                         $questions_uncorrect[$idLessonTrain['id']] = $userLessonTrainingQuestion->
                                where(['user_lesson_training_id' => $idLessonTrain['id'], 'correct' => 0])->
                                get();
                         $questions_uncorrect[$idLessonTrain['id']] = count($questions_uncorrect[$idLessonTrain['id']]);


                     }


                     $returnResult[$returnLessons[$key]['id']]['count_tests'] = $countTests;
                     $returnResult[$returnLessons[$key]['id']]['questions_correct'] = $questions_correct;
                     $returnResult[$returnLessons[$key]['id']]['questions_uncorrect'] = $questions_uncorrect;
                     $returnResult[$returnLessons[$key]['id']]['questions_all'] = $questions_all;
                 }




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
        $this->data['returnLessons'] = $returnLessons;
        $this->data['returnResult'] = $returnResult;
        return view('account.statistic.index', $this->data);
    }
}
