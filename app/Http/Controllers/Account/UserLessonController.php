<?php

namespace App\Http\Controllers\Account;

use App\Models\Training\Processing\Answer;
use App\Models\Training\Lesson\Lesson;
use App\Models\Training\Lesson\LessonsSettings;
use App\Models\User\UserLessonTraining;
use App\Services\CheckTraining\CheckTraining;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * Class UserLessonController
 * @package App\Http\Controllers\Account
 */
class UserLessonController extends Controller
{
    /**
     * @param Lesson $lesson
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function training(Lesson $lesson)
    {
        $user = Auth::user();

        $user_training = $user->lessonsTrainings()->where([
            'lesson_id' => $lesson->id,
            'type'      => 'training',
            'status'    => 'stop',
        ])->first();

        if ( ! $user_training) {
            $user_training = $user->lessonsTrainings()->create(['lesson_id' => $lesson->id, 'type' => 'training', 'status' => 'stop']);
        } else {
            $done_questions = $user_training->questions()->get()->pluck('question_id');
        }

        if (isset($done_questions) && count($done_questions)) {
            $questions = $lesson->questions()->whereNotIn('question_id', $done_questions)->get()->load('answers');
        } else {
            $questions = $lesson->questions()->get()->load('answers');
        }

        $settings_training = LessonsSettings::where('key', 'training_time')->first();
        $time              = (integer) $settings_training->value * count($questions) ?? count($questions) * 1;
//        $questions = $lesson->questions();
        return view('account.lessons.training', compact('questions', 'lesson', 'user_training', 'time'));
    }

    /**
     * @param UserLessonTraining $training
     * @param Request            $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkAnswerTraining(UserLessonTraining $training, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'answer_id' => 'required|exists:answers,id',
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        $answer = Answer::find($request->input('answer_id'))->makeVisible('correct');

        $response = \AnswerCheck::check($answer);

        $training->questions()->create(['question_id' => $answer->question_id, 'correct' => $response['correct'], 'answer_id' => $response['answer_id']]);

        return response()->json(['answer_id' => $response['answer_id'], 'correct' => $response['correct']], 200);
    }

    /**
     * @param UserLessonTraining $training
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkTraining(UserLessonTraining $training)
    {
        $user = Auth::user();

        if ( ! $user->lessonsTrainings()->find($training->id)) {
            return response()->json([], 406);
        }

        $response['right_count'] = $training->questions()->where('correct', 1)->count();
        $response['all_count']   = $training->questions()->count();
        if($response['right_count'] == $response['all_count']){
            $response['status']      = 'passed';
        }
        else{
            $response['status']      = 'failed';

        }

        $training->status = $response['status'];

        $training->save();

        return response()->json($response, 200);
    }

    /**
     * @param Lesson $lesson
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getExam(Lesson $lesson)
    {
        $user          = Auth::user();
        $user_exam     = $user->lessonsTrainings()->create([ 'lesson_id' => $lesson->id, 'type' => 'exam' ]);
        $questions     = $lesson->questions()->with('answers')->inRandomOrder()->limit(20)->get();
        $settings_exam = LessonsSettings::where('key', 'exam_time')->first();
        $time          = (integer) $settings_exam->value * count($questions) ?? count($questions) * 1;

        //$time = 1;

        return view('account.lessons.exam', compact('questions', 'lesson', 'user_exam', 'time'));
    }

    /**
     * @param UserLessonTraining $training
     * @param Request            $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkAnswerExam(UserLessonTraining $training, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'answer_id' => 'required|exists:answers,id',
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        $answer = Answer::find($request->input('answer_id'))->makeVisible('correct');

        $response = \AnswerCheck::check($answer);

        $training->questions()->create(['question_id' => $answer->question_id, 'correct' => $response['correct'], 'answer_id' => $answer->id]);

        return response()->json([], 200);
    }

    /**
     * @param UserLessonTraining $training
     * @param Request            $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkExam(UserLessonTraining $training, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lesson_ids' => 'required|array'
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        $user = Auth::user();

        if ( ! $user->lessonsTrainings()->find($training->id)) {
            return response()->json([], 406);
        }

        $lesson = Lesson::find($training->lesson_id);

        $response['right_count'] = $training->questions()->where('correct', 1)->count();
        $response['all_count'] = $lesson->questions()->count();
        if($response['all_count'] > 20){
            if($response['all_count']-3 <= $response['right_count']){
                $response['status'] = 'passed';
            }
            else{
                $response['status'] = 'failed';
            }
        }
        elseif ($response['all_count'] <=20 && $response['all_count'] > 10){
            if($response['all_count']-2 <= $response['right_count']){
                $response['status'] = 'passed';
            }
            else{
                $response['status'] = 'failed';
            }
        }
        elseif ($response['all_count'] <=10 && $response['all_count'] > 5){
            if($response['all_count']-1 <= $response['right_count']){
                $response['status'] = 'passed';
            }
            else{
                $response['status'] = 'failed';
            }
        }
        else{
            if($response['all_count'] == $response['right_count']){
                $response['status'] = 'passed';
            }
            else{
                $response['status'] = 'failed';
            }
        }

        $training->status = $response['status'];

        $training->save();

        /*
         * If exam failed
         */
        if ($response['status'] !== 'passed') return response()->json($response, 200);

        /*
         * If lesson has group exam
         */
        if ($lesson->getIsGroupAttribute()) {
            $response['group_exam'] = 1;

            return response()->json($response, 200);
        }

        /*
         * Add new lesson for user
         */
        $next_lesson     = $lesson->next_lesson;
        $response_lesson = $next_lesson->id ?? false;

        if ($next_lesson) {
            $user->lessonsVideos()->attach($next_lesson->videos);
            $user->lessons()->attach(['lesson_id' => $next_lesson->id]);
        }

        $response['next_lesson'] = $response_lesson;

        return response()->json($response, 200);
    }

    /**
     * @param Lesson $lesson
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function getGroupExam(Lesson $lesson)
    {
        $user = Auth::user();

        if ( ! $lesson->getIsGroupAttribute()) {
            return redirect('/account/lessons/' . $lesson->id);
        }

        if ( ! $user_video = $user->lessonsVideos->where('lesson_id', $lesson->id)->first()) {
            return redirect('/account/lessons/' . $lesson->id);
        }

        $group_limit = 3;
        $lessons     = Lesson::with('questions')
                                ->where('id', '<=', $lesson->lesson_num)
                                ->limit($group_limit)
                                ->offset($lesson->lesson_num - $group_limit)
                                ->get();

        $all_questions = [];

        foreach ($lessons as $item) {
            $question_tmp = $item->questions()->with('answers')->limit(20)->get()->toArray();

            foreach ($question_tmp as $question) {
                $all_questions[] = $question;
            }
        }

        shuffle($all_questions);

        $user_exam     = $user->lessonsTrainings()->create([ 'lesson_id' => $lesson->id, 'type' => 'group' ]);
        $questions     = $all_questions;
        $settings_exam = LessonsSettings::where('key', 'exam_time')->first();
        $time          = (integer) $settings_exam->value * count($questions) ?? count($questions) * 1;

        return view('account.lessons.group-exam', compact('questions', 'lessons', 'lesson', 'user_exam', 'time'));
    }

    /**
     * @param UserLessonTraining $training
     * @param Request            $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkGroupExam(UserLessonTraining $training, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_ids' => 'required|array',
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        $user = Auth::user();

        if ( ! $user->lessonsTrainings()->find($training->id)) {
            return response()->json([], 406);
        }

        $lesson = Lesson::find($training->lesson_id);

        $check_training = new CheckTraining($training);

        $response = $check_training->check($request->input('question_ids'));

        $response['right_count'] = $training->questions()->where('correct', 1)->count();

        $training->status = $response['status'];

        $training->save();

        /*
         * If exam failed
         */
        if ($response['status'] !== 'passed') return response()->json($response, 200);

        /*
         * Add new lesson for user
         */
        $next_lesson     = $lesson->next_lesson;
        $response_lesson = $next_lesson->id ?? false;

        if ($next_lesson) {
            $user->lessonsVideos()->attach($next_lesson->videos);
            $user->lessons()->attach(['lesson_id' => $next_lesson->id]);
        }

        $response['next_lesson'] = $response_lesson;

        return response()->json($response, 200);
    }
}
