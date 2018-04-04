<?php

namespace App\Http\Controllers\Account;

use App\Models\Training\Processing\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamsController extends Controller
{
    public  function  testPage(){

        $ticket_num = Question::max('ticket_num');
        $questions = Question::all();
        $this->data['ticket_num'] = $ticket_num;
        $ticketValue = [];
        $examsQuestion = [];
        $test = [];
        for($i= 1; $i<=12; $i++){
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

            for($k=1; $k<=5 ; $k++) {
                $qn = $k + 5 * ($i - 1);
                $questionNumber = 0;
                for ($l = 1; ; $l++) {
                    $questionNumber = rand(1, 20);
                    if(in_array($questionNumber, $questionNumbers, true)){

                    }
                    else{
                        array_push($questionNumbers, $questionNumber);
                        $examsQuestion[$qn] = $questions->where(['ticket_num' => $ticketNumber, 'question_num' => $questionNumber])->first();
                        break;
                    }
                }
            }

            }
        $this->data['ticketValue'] = $ticketValue;
        $this->data['examsQuestion'] = $examsQuestion;
        return view('account.exams.test', $this->data) ;
    }
}
