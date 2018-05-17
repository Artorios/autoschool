<?php

namespace App\Http\Controllers\Account;

use App\Models\Training\Processing\Answer;
use App\Models\Training\Processing\Question;
use App\Models\User\UserTicket;
use App\Models\User\UserTicketsAnswer;
use App\Services\AnswerCheck\Facade\AnswerCheck;
use App\Services\Settings\Facade\Settings;
use App\Services\Settings\SettingsException;
use App\Services\Tickets\Facade\Tickets;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

/**
 * Class TicketsController
 * @package App\Http\Controllers\Account
 */
class TicketsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $show_comment = Settings::get('show_comm_question', 0, 1);

        $tickets = Tickets::getTickets();

        return view('account.tickets.tickets', compact('show_comment', 'tickets'));
    }

    /**
     * @param $ticket
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function single($ticket)
    {
        if ( ! $ticket || ! Question::where('ticket_num', $ticket)->first()) {
            return redirect('/account/tickets');
        }

        /*
         * Array data has questions, user_ticket_id
         */
        $data                 = Tickets::getTicketData($ticket);
        $time_ticket          = Settings::get('time_ticket', 1);
        $data['time']         = $time_ticket * count($data['questions']);
        $data['with_comment'] = Settings::get('show_comm_question', 0, 1);

        return view('account.tickets.ticket-questions', compact('data'));
    }

    /**
     * @param UserTicket $ticket
     * @param Request    $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkAnswer(UserTicket $ticket, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'answer_id' => 'required|exists:answers,id',
            'quest_pos' => 'required',
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        $answer = Answer::find($request->input('answer_id'))->makeVisible('correct');

        $response = AnswerCheck::check($answer);

        $ticket->answers()->create(['question_id' => $answer->question_id, 'correct' => $response['correct'], 'answer_id' => $answer->id]);

        $position          = (int) $request->input('quest_pos') + 1;
        $incorrect_answers = $ticket->getIncorrectAnswersCountAttribute();
        $stop_test         = false;
        $questions         = null;

        if ( ! $response['correct'] && $position <= 5) {
            if ($incorrect_answers <= 1) {
                $questions = Question::whereNotIn('id', $ticket->answers()->get()->pluck('question_id'))
                                        ->with('answers')
                                        ->inRandomOrder()
                                        ->limit(5)
                                        ->get();
            } else {
                $stop_test = false;
            }
        } elseif ( ! $response['correct'] && $position <= 10) {
            if ($incorrect_answers <= 2) {
                $questions = Question::whereNotIn('id', $ticket->answers()->get()->pluck('question_id'))
                    ->with('answers')
                    ->inRandomOrder()
                    ->limit(5)
                    ->get();
            } else {
                $stop_test = false;
            }
        }  elseif ( ! $response['correct'] && $position <= 15) {
            if ($incorrect_answers <= 2) {
                $questions = Question::whereNotIn('id', $ticket->answers()->get()->pluck('question_id'))
                    ->with('answers')
                    ->inRandomOrder()
                    ->limit(5)
                    ->get();
            } else {
                $stop_test = false;
            }
        } elseif ( ! $response['correct'] && $position <= 20) {
            if ($incorrect_answers <= 2) {
                $questions = Question::whereNotIn('id', $ticket->answers()->get()->pluck('question_id'))
                    ->with('answers')
                    ->inRandomOrder()
                    ->limit(5)
                    ->get();
            } else {
                $stop_test = false;
            }
        } elseif ( ! $response['correct'] && $position <= 25) {
            if ($incorrect_answers <= 1) {
                $questions = Question::whereNotIn('id', $ticket->answers()->get()->pluck('question_id'))
                    ->with('answers')
                    ->inRandomOrder()
                    ->limit(5)
                    ->get();
            } else {
                $stop_test = false;
            }
        } elseif ( ! $response['correct'] && $position <= 30) {
            if ($incorrect_answers <= 1) {
                $questions = Question::whereNotIn('id', $ticket->answers()->get()->pluck('question_id'))
                    ->with('answers')
                    ->inRandomOrder()
                    ->limit(5)
                    ->get();
            } else {
                $stop_test = false;
            }
        } elseif ($incorrect_answers >= 3) {
            $stop_test = false;
        }

        $with_comment = Settings::get('show_comm_question', 0, 1);

        if ($with_comment) {
            $res = ['answer_id' => $response['answer_id'], 'correct' => $response['correct']];

            if ($questions) {
                $res['questions'] = $questions;
            }

            if ($stop_test) {
                $res['stop_test'] = false;
            }

            return response()->json($res, 200);
        } else {
            $res = [];

            if ($questions) {
                $res['questions'] = $questions;
            }

            if ($stop_test) {
                $res['stop_test'] = false;
            }

            return response()->json($res, 200);
        }
    }

    /**
     * @param UserTicket $ticket
     * @param Request    $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkTicket(UserTicket $ticket, Request $request)
    {
        $v = Validator::make($request->all(), [
            'questions' => 'required|array',
        ]);

        Tickets::setNonAnswers($ticket, $request->input('questions'));

        $ticket_error_num = Settings::get('ticket_error', 3);

        if ($ticket->getIncorrectAnswersCountAttribute() > 3) {
            $ticket->status = 'failed';

            $ticket->save();

            return response()->json(['status' => 'failed', 'right_count' => $ticket->getRightAnswersCountAttribute()], 200);
        } else {
            $ticket->status = 'passed';

            $ticket->save();

            return response()->json(['status' => 'passed'], 200);
        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function setShowAnswer(Request $request)
    {
        $v = Validator::make($request->all(), [
            'value' => ['required', Rule::in([0,1])],
        ]);

        if (count($v->errors())) {
            return response()->json(['status' => 0], 400);
        }

        try {
            $value = [
                'value' => $request->input('value'),
                'name'  => 'Показывать комментарии к вопросом',
            ];

            \Settings::set('show_comm_question', $value, 1);

            return response()->json(['status' => 1], 201);
        } catch (SettingsException $e) {
            return response()->json(['status' => 0, 'msg' => $e->getMessage()], 406);
        }
    }

    public function analysis($id)
    {
        $user = Auth::user();
        $question = UserTicketsAnswer::all();
        if ( ! $user->tickets()->find($id)) {
            return redirect('/account');
        }
        $quests = Question::all();
        $ticket = $user->tickets()->find($id);
        $questions        = $ticket->answers()->get(); //$question->load('answers')->where(['exam_id' => $id])->get();
        $question_list = [];
        foreach ($questions as $question){
            foreach ($quests as $quest) {
                if($quest->id == $question->question_id){
                    array_push($question_list,$quests->find($quest->id)->load('answers'));
                }
            }
        }
        $user_questions = $questions;
        $questions = $question_list;
        $return_questions = [];
        foreach ($user_questions as $user_question) {
            foreach ($questions as $question) {
                if ($question->id == $user_question->question_id) {
                    $question->correct        = (integer) $user_question->correct;
                    $question->user_answer_id = (integer) $user_question->answer_id;

                    if ( ! $user_question->correct) {
                        $question->correct_answer = Answer::where(['question_id' => $question->id, 'correct' => 1])
                            ->first()
                            ->makeVisible('correct');
                    }

                    array_push($return_questions, $question);
                }
            }
        }

        return view('account.tickets.analysis', compact('return_questions', 'ticket'));
    }

}
