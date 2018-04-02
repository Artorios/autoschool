<?php

namespace App\Http\Controllers\Admin\Questions;

use App\Models\Training\Processing\Question;
use ErrorException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/**
 * Class QuestionsController
 * @package App\Http\Controllers\Admin\Questions
 */
class QuestionsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $per_page  = 20;
        $questions = Question::select('ticket_num', \DB::raw('count(*) as count_questions'))->groupby('ticket_num')->paginate($per_page);

        return view('admin.questions.index', compact('questions'));
    }

    /**
     * @param $ticket_num
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single($ticket_num)
    {
        $per_page  = 20;
        $questions = Question::where('ticket_num', $ticket_num)->with('answers')->paginate($per_page);

        return view('admin.questions.single', compact('questions'));
    }

    /**
     * @param Question $question
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function singleQuestion(Question $question)
    {
        $ticket_list = Question::select('ticket_num')->groupBy('ticket_num')->get();

        $answers = $question->answers()->get()->makeVisible('correct');

        return view('admin.questions.quest', compact('question', 'answers', 'ticket_list'));
    }

    /**
     * @param Question $question
     * @param Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function editQuestion(Question $question, Request $request)
    {
        $v = Validator::make($request->all(), [
            'ticket_num'  => 'required|exists:questions,ticket_num',
            'description' => 'required|string',
            'comment'     => 'required|string',
        ]);

        $image = $request->input('image');

        if (count($v->errors())) {
            return response()->json(['errors' => $v->errors()], 400);
        }

        $question->update($request->only(['ticket_num', 'description', 'comment']));
        if ($image) {
            if (Storage::exists('public/tmp/' . $image)) {
                Storage::deleteDirectory('public/question/' . $question->id . '/');

                Storage::move('public/tmp/' . $image, 'public/question/' . $question->id . '/' . $image);
                $question->update(['image_src' => $image]);
            }
        } else {
            if (Storage::exists('public/question/' . $question->id . '/' . $image)) {
                Storage::deleteDirectory('public/question/' . $question->id . '/');
            }
        }

        return response()->json([], 202);
    }

    /**
     * @param Question $question
     * @param Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function editAnswers(Question $question, Request $request)
    {
        $v = Validator::make($request->all(), [
            'answers'           => 'required|array',
            'answers.*.title'   => 'required|string',
            'answers.*.correct' => array( 'required', Rule::in([ 0, 1 ]) ),
        ]);

        if (count($v->errors())) {
            return response()->json(['errors' => $v->errors()], 400);
        }

        $answers = $request->input('answers');

        $question->answers()->delete();

        foreach ($answers as $answer) {
            $question->answers()->updateOrCreate(['id' => $answer['id']], ['title' => $answer['title'], 'correct' => $answer['correct']]);
        }

        return response()->json([], 202);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getQuestions(Request $request)
    {
        $per_page = 20;

        $validator = Validator::make($request->all(), [
            'q'            => 'string|min:3',
            'ticket_num'   => 'integer|exists:questions,ticket_num',
            'group_ticket' => 'integer',
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        $questions = Question::query();

        if ($request->input('ticket_num')) {
            $questions->where('ticket_num', $request->input('ticket_num'));
        } else if ($request->input('group_ticket')) {
            $questions->select('ticket_num', \DB::raw('count(*) as count_questions'))->groupby('ticket_num');
        }

        if ($request->input('q')) {
            $query_search = $request->input('q');

            $questions
                ->where('title', 'like', '%' . $query_search . '%')
                ->orWhere('description', 'like', '%' . $query_search . '%');
        }

        return response()->json(['questions' => $questions->paginate($per_page)], 200);
    }

    /**
     * @param Question $question
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Question $question)
    {
        try {
            $question->delete();

            return response()->json(['status' => 1], 202);
        } catch (\ErrorException $e) {
            return response()->json(['status' => 0], 400);
        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description'       => 'required|string',
            'comment'           => 'required|string',
            'answers'           => 'required|array',
            'answers.*.title'   => 'required|string',
            'answers.*.correct' => ['required', Rule::in([1,0])],
            'image'             => 'array',
            'image.name'        => 'string',
            'ticket_num'        => 'required|integer',
            'question_num'      => 'required|integer',
        ]);

        //dd($validator->errors());

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        try {
            $question = Question::create($request->only([
                'description',
                'comment',
                'ticket_num',
                'question_num'
            ]));

            $question->answers()->createMany($request->input('answers'));

            $image = $request->input('image');

            if ($image) {
                Storage::move('public/tmp/' . $image['name'], 'public/question/' . $question->id . '/' . $image['name']);

            }

            return response()->json(['status' => 1], 201);
        } catch (ErrorException $e) {
           return response()->json(['status' => 0], 400);
        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image',
        ]);

        if (count($validator->errors())) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $file      = $request->file('image');
            $file_name = sha1_file($file) . $file->getCTime() . '.' . $file->getClientOriginalExtension();

            Storage::putFileAs('public/tmp', $file, $file_name);

            return response()->json(['image' => env('APP_URL') . '/storage/tmp/' . $file_name, 'name' => $file_name], 201);
        } catch (ErrorException $e) {
            return response()->json(['status' => 0], 400);
        }
    }
}
