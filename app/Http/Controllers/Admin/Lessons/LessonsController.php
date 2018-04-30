<?php

namespace App\Http\Controllers\Admin\Lessons;

use App\Http\Requests\StoreLesson;
use App\Models\Training\Lesson\Lesson;
use App\Models\Training\Lesson\LessonVideo;
use App\Models\Training\Processing\Question;
use ErrorException;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/**
 * Class LessonsController
 * @package App\Http\Controllers\Admin\Lessons
 */
class LessonsController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {

        $lesson = Lesson::create($request->validated());

        return response()->json(['status' => 1], 201);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loadVideo(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'video'     => 'required|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4',
            'lesson_id' => 'sometimes|exists:lessons,id',
        ]);

        if (count($validator->errors())) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $file      = $request->file('video');
            $file_name = sha1_file($file) . $file->getCTime() . '.' . $file->getClientOriginalExtension();

            if ($request->input('lesson_id')) {
                $lesson = Lesson::find($request->input('lesson_id'));
                $video = LessonVideo::find($request->input('video_id'));
                if($video->id){
                    $video->update(['name' => $file_name, 'mime_type' => $file->getMimeType()]);
                    Storage::putFileAs('public/lesson_video/' . $video->id . '/', $file, $file_name);
                }
                else{
                    $tmp_video = $lesson->videos()->create(['name' => $file_name, 'mime_type' => $file->getMimeType()]);
                    Storage::putFileAs('public/lesson_video/' . $tmp_video->id . '/', $file, $file_name);
                }


            } else {
                Storage::putFileAs('public/tmp', $file, $file_name);
            }

            return response()->json(['status' => 1], 201);
        } catch (ErrorException $e) {
            return response()->json(['status' => 0], 402);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $per_page = 20;
        $lessons  = Lesson::with('videos')->paginate($per_page);

        return view('admin.lesson.index', compact('lessons'));
    }

    /**
     * @param Lesson $lesson
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single(Lesson $lesson)
    {
        $per_page = 20;

        $lesson->load('videos', 'questions');

        $questions = Question::paginate($per_page);

        if (count($lesson->questions)) {
            foreach ($lesson->questions as $lesson_question) {
                foreach ($questions as $question) {
                    if ($question->id === $lesson_question->id) {
                        $question->checked = 1;
                    }
                }
            }
        }

        $all_tickets = Question::distinct()->get(['ticket_num'])->pluck('ticket_num')->toArray();

        return view('admin.lesson.single', compact('lesson', 'questions', 'all_tickets'));
    }

    /**
     * @param Lesson  $lesson
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getQuestions(Lesson $lesson, Request $request)
    {
        $per_page = 20;
        $q        = $request->input('q');
        $ticket   = $request->input('ticket');
        $search   = [];

        if ($ticket && $ticket !== 'all') {
            array_push($search, ['ticket_num', '=', $ticket]);
        }

        if ($q) {
            array_push($search, ['description', 'like', '%' . $q . '%']);
        }

        if ( ! count($search)) {
            $questions = Question::paginate($per_page);
        } else {
            $questions = Question::where($search)->paginate($per_page);
        }

        if (count($lesson->questions)) {
            foreach ($lesson->questions as $lesson_question) {
                foreach ($questions as $question) {
                    if ($question->id === $lesson_question->id) {
                        $question->checked = 1;
                    }
                }
            }
        }

        return response()->json(['questions' => $questions], 200);
    }

    /**
     * @param Lesson  $lesson
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeQuestion(Lesson $lesson, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_id' => 'required|exists:questions,id',
            'checked'     => ['required', Rule::in([1,0])],
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        if ($request->input('checked')) {
            $lesson->questions()->attach($request->input('question_id'));
        } else {
            $lesson->questions()->detach($request->input('question_id'));
        }

        return response()->json(['status' => 1], 201);
    }

    /**
     * @param Lesson $lesson
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Lesson $lesson)
    {
        $lesson->delete();

        return response()->json([], 202);
    }

    /**
     * @param Lesson  $lesson
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function editLesson(Lesson $lesson, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'               => 'string',
            'description'         => 'string',
            'training_errors_num' => 'integer',
            'exam_errors_num'     => 'integer',
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        try {
            $lesson->update($request->only(['description', 'exam_errors_num', 'training_errors_num', 'title']));

            return response()->json(['status' => 1], 202);
        } catch (ErrorException $e) {
            return response()->json(['status' => 0], 406);
        }
    }

    /**
     * @param LessonVideo $video
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delVideo(LessonVideo $video)
    {
        try {
            Storage::delete('public/lesson_video/' . $video->name);

            $video->update(['name' => '', 'mime_type' => '']);

            return response()->json([], 202);
        } catch (\ErrorException $e) {
            return response()->json([], 406);
        }
    }
    public function youtube(LessonVideo $lessonVideo, Request $request, $id)
    {
        $item = $request->input();
        if($lessonVideo->where(['id' => $id])->update(['youtube' => $item['youtube']])){
            return response()->json(['status' => $item], 202);

        }
        else{
            return response()->json(['status' => 0], 406);

        }

    }

}
