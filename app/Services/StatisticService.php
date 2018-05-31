<?php

namespace App\Services;

use App\Models\User\UserLessonTraining;

class StatisticService
{
    public function progress($user, $lessons, $userLessonTrainingQuestion)
    {
        $returnLessons = [];
        $returnResult = [];
        $countTests = [];

        foreach ($lessons as $key => $lesson) {
            $returnLessons[$key] = $lesson;
            $user_video          = $user->lessonsVideos()->where('lesson_id', $returnLessons[$key]['id'])->orderBy('id', 'DESC')->first();
            $last_train          = $user->lessonsTrainings()->where(['lesson_id' => $returnLessons[$key]['id'], 'type' => 'training'])->where('status', '!=', null)->orderBy('id', 'DESC')->first();
            $last_exam           = $user->lessonsTrainings()->where(['lesson_id' => $returnLessons[$key]['id'], 'type' => 'exam'])->where('status', '!=', null)->orderBy('id', 'DESC')->first();
            if($lesson['isGroup']){
                $last_group           = $user->lessonsTrainings()->where(['lesson_id' => $returnLessons[$key]['id'], 'type' => 'group'])->where('status', '!=', null)->orderBy('id', 'DESC')->first();
            }


            $returnResult[$returnLessons[$key]['id']]['lesson'] = $returnLessons[$key]['id'];
            $countTests = $user->lessonsTrainings()->where(['lesson_id' => $returnLessons[$key]['id']])->get();
            $countTests = count($countTests);
            if(!empty($countTests)){
                $idLessonTrains = $user->lessonsTrainings()->where(['lesson_id' => $returnLessons[$key]['id']])->orderBy('id', 'ASC')->get();
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
                $returnLessons[$key]['viewed_date'] = $user->videos->where('lesson_video_id', $user_video->id)->first()->updated_at;
            }

            if ($last_train && $last_train->status) {
                $returnLessons[$key]['last_training']     = $last_train->status;
                $returnLessons[$key]['last_training_date']     = explode(' ', $last_train->updated_at)['0'];
                $returnLessons[$key]['right_quest_train'] = $last_train->questions()->where('correct', 1)->count();
                $returnLessons[$key]['all_quest_train']   = $last_train->questions()->count();
            }

            if ($last_exam && $last_exam->status) {
                $returnLessons[$key]['last_exam']        = $last_exam->status;
                $returnLessons[$key]['last_exam_date']        = explode(' ', $last_exam->updated_at)['0'];
                $returnLessons[$key]['right_quest_exam'] = $last_exam->questions()->where('correct', 1)->count();
                $returnLessons[$key]['all_quest_exam']   = $last_exam->questions()->count();
            }

            if (isset($last_group) && $last_group->status) {
                $returnLessons[$key]['last_group']     = $last_group->status;
                $returnLessons[$key]['last_group_date']     = explode(' ', $last_group->updated_at)['0'];
                $returnLessons[$key]['right_quest_group'] = $last_group->questions()->where('correct', 1)->count();
                $returnLessons[$key]['all_quest_group']   = $last_group->questions()->count();
            }
        }
        $data['returnLessons'] = $returnLessons;
        $data['returnResult'] = $returnResult;
        return $data;
    }

    public function exam($user)
    {
        $data['exams'] = $user->exams()->paginate(8);
        $data['correct_number'] = [];
        $data['all_number'] = [];
        foreach ($data['exams'] as $exam){
            $data['correct_number'][$exam->id] = $exam->questions()->where(['correct' => '1'])->count();
            $data['all_number'][$exam->id] = $exam->questions()->count();
        }
        return $data;
    }
}