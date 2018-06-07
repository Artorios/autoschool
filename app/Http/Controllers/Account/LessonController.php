<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Training\Processing\Answer;
use App\Models\Training\Lesson\Lesson;
use App\Models\Training\Lesson\LessonsSettings;
use App\Models\Training\School\AutoSchoolGroup;
use App\Models\User\Coupon;
use App\Models\User\User;
use App\Models\User\UserLesson;
use App\Models\User\UserLessonTraining;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * Class LessonController
 * @package App\Http\Controllers\Account
 */
class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Lesson::count()) {
            return redirect('/account');
        }

        $user = Auth::user();
        if (!$user->lessons()->where('license', Auth::user()->license)->count()) {
            $lesson = Lesson::with('videos')->where('license', Auth::user()->license)->orderBy('lesson_num', 'ASC' )->first();

            $user->lessonsVideos()->attach($lesson->videos);

            $user->lessons()->attach(['lesson_id' => $lesson->id]);

            if($this->checkIfUserPaid($user)) {
                return $this->getDemoLesson();
            }
        }

        if($this->checkIfUserPaid($user)) {
            return $this->getDemoLesson();
        }

        $lessons = Lesson::where('license', auth()->user()->license)->orderBy('lesson_num', 'ASC' )->get();
//        $lessons = Lesson::all();

        $user_lessons = $user->lessons;


        foreach ($user_lessons as $user_lesson) {
            foreach ($lessons as $lesson) {
                if ($user_lesson->id === $lesson->id) {
                    $lesson->locked = 0;
                }
            }
        }
        return view('account.lessons.index', compact('lessons'));
    }

    /**
     * Display the specified resource.
     *
     * @param Lesson $lesson
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        $user = Auth::user();
        if (!$user->lessons()->find($lesson->id)) {
            return redirect('/account/lessons');
        }

        $lesson = \LessonRules::checkRules($lesson);


        return view('account.lessons.single', compact('lesson'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function videoTimeSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'time' => 'required',
            'video_id' => 'required|exists:lesson_videos,id',
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        $user = Auth::user();

        if (!$user_video = $user->lessonsVideos->where('id', $request->input('video_id'))->first()) {
            return response()->json(['status' => 0], 400);
        }

        $user_video->pivot->time_stop_view = $request->input('time');

        $user_video->pivot->save();

        return response()->json(['status' => 1], 201);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function endView(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'video_id' => 'required|exists:lesson_videos,id'
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        $user = Auth::user();

        if (!$user_video = $user->lessonsVideos->where('id', $request->input('video_id'))->first()) {
            return response()->json(['status' => 0], 400);
        }

        $user_video->pivot->time_stop_view = null;
        $user_video->pivot->viewed = 1;
        $user_video->pivot->updated_at = Carbon::now();
        $user_video->pivot->update();

        return response()->json(['status' => 1], 201);
    }

    /**
     * @param UserLessonTraining $training
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function analysis(UserLessonTraining $training)
    {
        $user = Auth::user();

        if (!$user->lessonsTrainings()->find($training->id)) {
            return redirect('/account');
        }

        $lesson = Lesson::find($training->lesson_id);
        $questions = $lesson->questions->load('answers');
        $user_questions = $training->questions;
        $training = $training->type;
        $return_questions = [];
        $lessons = [];

        if ($training === "group") {
            $group_limit = 3;
            $lessons = Lesson::with('questions')
                ->where('license', Auth::user()->license)
                ->where('id', '<=', $lesson->lesson_num)
                ->limit($group_limit)
                ->offset($lesson->lesson_num - $group_limit)
                ->get();

            $questions = [];

            foreach ($lessons as $item) {
                $question_per_lesson = $item->questions->load('answers');
                foreach ($question_per_lesson as $one_question) {
                    array_push($questions, $one_question);
                }

            }

            $temp_array = array();
            $i = 0;
            $key_array = array();

            foreach ($questions as $val) {
                if (!in_array($val['id'], $key_array)) {
                    $key_array[$i] = $val['id'];
                    $temp_array[$i] = $val;
                }
                $i++;
            }
            $questions = $temp_array;
        }

        foreach ($user_questions as $user_question) {
            foreach ($questions as $question) {
                if ($question->id == $user_question->question_id) {
                    $question->correct = (integer)$user_question->correct;
                    $question->user_answer_id = (integer)$user_question->answer_id;

                    if (!$user_question->correct) {
                        $question->correct_answer = Answer::where(['question_id' => $question->id, 'correct' => 1])
                            ->first()
                            ->makeVisible('correct');
                    }

                    array_push($return_questions, $question);
                }
            }
        }

        return view('account.lessons.analysis', compact('return_questions', 'lessons', 'lesson', 'training'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCountLesson()
    {
        $user = Auth::user();
        $count = UserLesson::where('user_id', $user->id)->select(['user_id', 'lesson_id'])->groupBy(['user_id', 'lesson_id'])->get()->toArray();
        $all_lessons = Lesson::all()->count();

        return response()->json(['done_lessons' => count($count), 'all_lessons' => $all_lessons], 202);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCurrentLesson()
    {
        $user = Auth::user();
        $lesson = $user->lessons()->where('license', Auth::user()->license)->orderby('lesson_num', 'desc')->first();
        $type = '';

        if (!$lesson) {
            $type = 'getFirst';

            return response()->json(['type' => $type, 'lesson' => null]);
        }

        $video_viewed = $user->lessonsVideos()->where('lesson_id', $lesson->id)->first();

        if (!$video_viewed->pivot->viewed) {
            $type = 'notViewed';

            return response()->json(['type' => $type, 'lesson' => $lesson]);
        }

        $training = $user->lessonsTrainings()->where(['lesson_id' => $lesson->id, 'status' => 'passed', 'type' => 'training'])->first();

        if (!$training) {
            $type = 'notTraining';

            return response()->json(['type' => $type, 'lesson' => $lesson]);
        }

        $exam = $user->lessonsTrainings()->where(['lesson_id' => $lesson->id, 'status' => 'passed', 'type' => 'exam'])->first();

        if (!$exam) {
            $type = 'notExam';

            return response()->json(['type' => $type, 'lesson' => $lesson]);
        }

        $group_exam = $user->lessonsTrainings()->where(['lesson_id' => $lesson->id, 'status' => 'passed', 'type' => 'group'])->first();

        if (!$group_exam) {
            $type = 'notGroup';

            return response()->json(['type' => $type, 'lesson' => $lesson]);
        }

        $type = 'allDone';

        return response()->json(['type' => $type, 'lesson' => $lesson]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLessonsSlider()
    {
        $user = Auth::user();
        $lessons = Lesson::where('license', Auth::user()->license)->get();
        $user_lessons = $user->lessons;

        foreach ($user_lessons as $user_lesson) {
            foreach ($lessons as $lesson) {
                if ($user_lesson->id === $lesson->id) {
                    $lesson->locked = 0;
                    $video_viewed = $user->lessonsVideos()->where('lesson_id', $lesson->id)->first();
                    $lesson->training = $video_viewed->pivot->viewed ? 1 : 0;
                    $training = $user->lessonsTrainings()->where(['lesson_id' => $lesson->id, 'type' => 'training', 'status' => 'passed'])->first();
                    $lesson->exam = $training ? 1 : 0;
                }
            }
        }

        return response()->json(['lessons' => $lessons], 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */

    public function getCountSchoolExam()
    {
        $user = Auth::user();
        $groups = AutoSchoolGroup::all();
        $days = ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'];
        $actualTime = time();
        foreach ($groups as $group) {
            if ($group->id === $user->auto_school_group_id) {
                $date = $group->exam_date;
                $time = $group->exam_time;
                $tempLeftDay = strtotime($date) - $actualTime;
                if ($tempLeftDay > 0) {
                    $tempDate = explode('-', $date);
                    $tempTime = explode(':', $time);
                    $tempDay = strftime("%w", strtotime($date));
                    $date = $tempDate['2'] . '.' . $tempDate['1'] . '.' . $tempDate['0'];
                    $time = $tempTime['0'] . ':' . $tempTime['1'];
                    $day = $days[$tempDay];
                    $leftDay = floor($tempLeftDay / 86400);
                }
            }
        }

        return response()->json(['date' => $date, 'time' => $time, 'day' => $day, 'leftDay' => $leftDay]);
    }

    public function getGroupLessons(Request $request)
    {
        $group_limit = 3;
        $lessons = Lesson::with('questions')
            ->where('license', Auth::user()->license)
            ->where('id', '<=', $request->lesson_num)
            ->limit($group_limit)
            ->offset($request->lesson_num - $group_limit)
            ->get();

        return response()->json(['lessons' => $lessons], 200);
    }

    public function showDemoLesson(Lesson $lesson)
    {
        $lesson = \LessonRules::checkRules($lesson);

        return view('account.lessons.single', compact('lesson'));
    }

    private function checkIfUserPaid($user)
    {
        $payedUser = Coupon::where('student_id', $user->id)->get();
        return $payedUser->isEmpty() ? true : false;
    }

    private function getDemoLesson()
    {
        $lesson = Lesson::where('license', Auth::user()->license)->orderBy('lesson_num', 'ASC' )->first();
        return view('account.lessons.demo', compact('lesson'));
    }
}
