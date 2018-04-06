<?php

namespace App\Http\Controllers\Account;

use App\Models\Training\Processing\Question;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Training\Lesson\LessonsSettings;
use Illuminate\Support\Facades\Auth;
use App\Models\Training\Exam;

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

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        $answer = Answer::find($request->input('answer_id'))->makeVisible('correct');

        $response = \AnswerCheck::check($answer);

        $exams->questions()->create(['question_id' => $answer->question_id, 'correct' => $response['correct'], 'answer_id' => $response['answer_id']]);

        return response()->json([], 200);
    }

    public function checkExam(Exams $exams, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lesson_ids' => 'required|array'
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        $user = Auth::user();

        if ( ! $user->lessonsTrainings()->find($exams->id)) {
            return response()->json([], 406);
        }


        $check_training = new CheckTraining($exams);

        $response = $check_training->check($request->input('lesson_id'));

        $response['right_count'] = $exams->questions()->where('correct', 1)->count();

        $exams->status = $response['status'];

        $exams->save();

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
}
