<?php

namespace App\Http\Controllers\Admin\Lessons;

use App\Http\Controllers\Controller;
use App\Http\Requests\{
    StoreLesson, StoreVideo, UpdateLesson, UpdateQuestion
};
use App\Models\Training\Processing\Question;
use App\Models\Training\Lesson\{
    Lesson, LessonVideo
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Storage, DB
};

/**
 * Class LessonsController
 * @package App\Http\Controllers\Admin\Lessons
 */
class LessonsController extends Controller
{

    /**
     * @var int $perPage
     */
    private $perPage = 20;

    /**
     * @param StoreLesson $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(StoreLesson $request)
    {
        $file_data = [];
        if(!empty($request->get('videos_name')) && !empty($request->get('videos_type'))) {
            $file_data['mime_type'] = $request->get('videos_type');
            $file_data['name'] = $request->get('videos_name');

        }

        $video_data = [];
        try {
            DB::transaction(function () use ($request, $file_data) {

                $lesson = Lesson::create($request->only(['title', 'description', 'lesson_num']));
                if (!empty($request->only('youtube')) && empty($file_data)) {
                    $video_data = $lesson->videos()->create($request->only('youtube'));


                }
                elseif (!empty($file_data) && empty($request->only('youtube'))) {
                    $video_data = $lesson->videos()->create($file_data);
                    Storage::move('public/tmp/' . $file_data['name'], 'public/lesson_video/' . $video_data->id . '/' . $file_data['name']);
                }
                elseif (!empty($file_data) && !empty($request->only('youtube'))){
                    $file_data['youtube'] = $request->get('youtube');
                    $video_data = $lesson->videos()->create($file_data);
                    Storage::move('public/tmp/' . $file_data['name'], 'public/lesson_video/' . $video_data->id . '/' . $file_data['name']);

                }

            });
            if(!empty($video_data)){
                Storage::move('public/tmp/' . $file_data['name'], 'public/lesson_video/' . $video_data->id . '/' . $file_data['name']);
            }
            return response()->json(['status' => 1, 'name' => $file_data['name'], 'type' => $file_data['mime_type']], 201);
        }

        catch (Exception $e){
            return response()->json(['status' => 0], 402);
        }
    }

    /**
     * @param StoreVideo $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loadVideo(StoreVideo $request)
    {
        $file = $request->file('video');
        $file_name = sprintf(
            "%s%s.%s",
            sha1_file($file),
            $file->getCTime(),
            $file->getClientOriginalExtension()
        );

        if ($request->get('lesson_id')) {
            $lesson = Lesson::find($request->get('lesson_id'))->with('videos');
            $source = ['name' => $file_name, 'mime_type' => $file->getMimeType()];

            if ($video = $lesson->videos()->get($request->file('video_id'))) {
                $video->update($source);
            } else {
                $video = $lesson->videos()->create($source);
            }

            Storage::putFileAs(sprintf('public/lesson_video/%s/', $video->id), $file, $file_name);


        } else {
            Storage::putFileAs('public/tmp', $file, $file_name);
        }

        return response()->json(['status' => 1, 'name' => $file_name, 'type' => $file->getMimeType()], 201);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $lessons = Lesson::with('videos')->paginate(20);
        return view('admin.lesson.index', compact('lessons'));
    }

    /**
     * @param Lesson $lesson
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single(Lesson $lesson)
    {
        $lesson->load('videos', 'questions');
        $questions = Question::paginate($this->perPage);

        foreach ($lesson->questions as $lesson_question) {
            foreach ($questions as $question) {
                if ($question->id === $lesson_question->id) {
                    $question->checked = 1;
                }
            }
        }

        $all_tickets = Question::distinct()->get(['ticket_num'])->pluck('ticket_num')->toArray();

        return view('admin.lesson.single', compact('lesson', 'questions', 'all_tickets'));
    }

    /**
     * @param Lesson $lesson
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getQuestions(Lesson $lesson, Request $request)
    {
        $q = $request->get('q');
        $ticket = $request->get('ticket');
        $search = [];

        if ($ticket && $ticket !== 'all') {
            array_push($search, ['ticket_num', '=', $ticket]);
        }

        if ($q) {
            array_push($search, ['description', 'like', '%' . $q . '%']);
        }

        if (!count($search)) {
            $questions = Question::paginate($this->perPage);
        } else {
            $questions = Question::where($search)->paginate($this->perPage);
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
     * @param Lesson $lesson
     * @param UpdateQuestion $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeQuestion(Lesson $lesson, UpdateQuestion $request)
    {
        $questions = $lesson->questions();
        $request->get('checked') ?
            $questions->attach($request->input('question_id')) :
            $questions->detach($request->input('question_id'));

        return response()->json(['status' => 1], \Illuminate\Http\Response::HTTP_OK);
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
     * @param Lesson $lesson
     * @param UpdateLesson $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function editLesson(Lesson $lesson, UpdateLesson $request)
    {
        $lesson->update($request->validated());
        return response()->json(['status' => 1], 202);
    }

    /**
     * @param LessonVideo $video
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delVideo(LessonVideo $video)
    {
        Storage::delete(sprintf('public/lesson_video/%s', $video->name));
        $video->update(['name' => '', 'mime_type' => '']);

        return response()->json([], 202);
    }

    /**
     * @param LessonVideo $lessonVideo
     * @param Request $request
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function youtube(LessonVideo $lessonVideo, Request $request, $id)
    {
        $response = $lessonVideo->where(['id' => $id])->update($request->all()) ?
            [['status' => $request->get('youtube')], 202] :
            [['status' => 0], 406];

        return response()->json(...$response);
    }

}
