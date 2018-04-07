<?php

namespace App\Http\Controllers\Account;

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
        for($i= 0; $i<=0; $i++){
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
        if($response['right_count'] == 2){
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
}
