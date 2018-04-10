<?php

namespace App\Http\Controllers\Account;

use App\Models\Training\Exam\ExamQuestion;
use App\Models\Training\Processing\Question;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Training\Lesson\LessonsSettings;
use Illuminate\Support\Facades\Auth;
use App\Models\Training\Exam\Exam;
use App\Models\Training\Processing\Answer;
use Illuminate\Support\Facades\Validator;
class ExamsController extends Controller
{
    public function index(){
        $user = Auth::user();

        $this->data['exams'] = $user->exams()->paginate(8);
        $this->data['correct_number'] = [];
        $this->data['all_number'] = [];
        foreach ($this->data['exams'] as $exam){
            $this->data['correct_number'][$exam->id] = $exam->questions()->where(['correct' => '1'])->count();
            $this->data['all_number'][$exam->id] = $exam->questions()->count();
        }

        return view('account.exams.index', $this->data);
    }

    public  function  testPage(){
        $user = Auth::user();
        $ticket_num = Question::max('ticket_num');
        $questions = Question::all();
        $this->data['ticket_num'] = $ticket_num;
        $settings_exam = LessonsSettings::where('key', 'exam_time')->first();
        $ticketValue = [];
        $examsQuestion = [];
        $user_exam     = $user->exams()->create(['type' => 'test']);
        $test = [];
        for($i= 0; $i<=11; $i++){
            $ticketNumber = 0;
            $questionNumbers = [];
            for($j=1; ; $j++){
                $ticketNumber = rand(1, 15);
                if(in_array($ticketNumber,$ticketValue, true )){
                    }
                    else{
                        array_push($ticketValue, $ticketNumber);
                        break;
                    }
            }

            for($k=0; $k<=4 ; $k++) {
                $qn = $k + 5 * ($i);
                $questionNumber = 0;
                for ($l = 1; ; $l++) {
                    $questionNumber = rand(1, 20);
                    if(in_array($questionNumber, $questionNumbers, true)){

                    }
                    else{
                        array_push($questionNumbers, $questionNumber);
                        $examsQuestion[$qn] = $questions->load('answers')->where('ticket_num' , $ticketNumber)->where( 'question_num',$questionNumber)->first();
                        break;
                    }
                }
            }

            }


        $this->data['ticketValue'] = $ticketValue;
//        $this->data['answer'] = $anwser;
        $this->data['userExam'] = $user_exam;
        $this->data['examsQuestion'] = $examsQuestion;
        $this->data['time']          = (integer) $settings_exam->value * count($examsQuestion) ?? count($examsQuestion) * 1;
        return view('account.exams.testExam', $this->data) ;
    }

    public function checkAnswerExam(Exam $exams, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'answer_id' => 'required|exists:answers,id',
        ]);
        $user = Auth::user();
        $exams = $exams->where(['user_id' => $user->id])->orderBy('updated_at', 'desc')->first();

        $answer = Answer::find($request->input('answer_id'))->makeVisible('correct');

        if($answer->correct === 1){
            $exams->questions()->create(['question_id' => $answer->question_id, 'correct' => 1, 'answer_id' => $request->input('answer_id')]);
        }
        else{
            $exams->questions()->create(['question_id' => $answer->question_id, 'correct' => 0, 'answer_id' => $request->input('answer_id')]);

        }


        return response()->json([], 200);
    }

    public function checkExam(Exam $exams)
    {
        $user = Auth::user();
        $exams = $exams->where(['user_id' => $user->id])->orderBy('updated_at', 'desc')->first();


        $response['right_count'] = $exams->questions()->where('correct', 1)->count();
        $response['unright_count'] = $exams->questions()->where('correct', 0)->count();
        if($response['right_count'] == 60){
            $exams->status = '1';
            $response['status'] = 'passed';
        }
        else {
            $exams->status = '0';
            $response['status'] = 'failed';

        }

        $exams->update();

        /*
         * If exam failed
         */
        if ($exams->status !== 1) return response()->json($response, 200);

        /*
         * If lesson has group exam
         */


        /*
         * Add new lesson for user
         */

        return response()->json($response, 200);
    }
    public function analysis($id)
    {
        $user = Auth::user();
        $exam = Exam::all();
        $questionEx = ExamQuestion::all();
        if ( ! $user->exams()->find($id)) {
            return redirect('/account');
        }
        $quests = Question::all();
        $exam = $user->exams()->find($id);
        $questions        = $exam->questions()->get(); //$question->load('answers')->where(['exam_id' => $id])->get();
        $question_list = [];
        foreach ($questions as $question){
            foreach ($quests as $quest) {
                if($quest->id == $question->question_id){
                    array_push($question_list,$quests->find($quest->id)->load('answers'));
                }
            }
        }
        $user_questions   = $exam->questions;
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

        return view('account.exams.analysis', compact('return_questions'));
    }
}
