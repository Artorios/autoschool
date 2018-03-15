<?php

namespace App\Services\Tickets;

use App\Models\Training\Processing\Question;
use App\Models\User\UserTicket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Class Tickets
 * @package App\Services\Tickets
 */
class Tickets implements TicketsInterface
{
    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    protected $user;

    /**
     * Tickets constructor.
     */
    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * @return array
     */
    public function getTickets() :array
    {
        $tickets = Question::select('ticket_num')->groupBy('ticket_num')->get()->toArray();

        if ( ! $this->user->tickets()->where('status', '!=', null)->count()) {
            $response = [];

            foreach ($tickets as $key => $ticket) {
                $response[$key]['ticket_id'] = $ticket['ticket_num'];
                $response[$key]['status']    = null;
            }

            return $response;
        }

        $user_tickets = $this->user->tickets()->select('ticket_num')->groupBy('ticket_num')->get()->toArray();

        $result = $this->compareTickets($tickets, $user_tickets);

        return $result;
    }

    /**
     * @param int $ticket
     *
     * @return array
     */
    public function getTicketData(int $ticket) :array
    {
        /*
         * Create user_try_ticket
         */
        $user_ticket = $this->user->tickets()->create(['ticket_num' => $ticket]);

        $questions = Question::with('answers')->where('ticket_num', $ticket)->get()->toArray();

        shuffle($questions);

        return ['user_ticket_id' => $user_ticket->id, 'questions' => $questions];
    }

    /**
     * @return mixed|void
     */
    public function getInfo()
    {
        // TODO: Implement getInfo() method.
    }

    /**
     * @return mixed|void
     */
    public function getAnalysis()
    {
        // TODO: Implement getAnalysis() method.
    }

    /**
     * @param UserTicket $ticket
     * @param array      $data
     *
     * @throws TicketException
     */
    public function setNonAnswers(UserTicket $ticket, array $data)
    {
        if ( ! count($data)) {
            throw new TicketException('Билеты отсутствуют');
        }

        $ticket_questions = $ticket->answers()->get()->pluck('question_id')->toArray();

        $diff = array_diff($data, $ticket_questions);

        foreach ($diff as $item) {
            $ticket->answers()->create(['question_id' => $item, 'correct' => 0, 'answer_id' => 0]);
        }
    }

    /**
     * @param array $tickets
     * @param array $user_tickets
     * @return array
     */
    private function compareTickets(array $tickets, array $user_tickets) :array
    {
        $return_tickets = [];

        foreach ($tickets as $key => $ticket) {
            $return_tickets[$key]              = $ticket;
            $return_tickets[$key]['ticket_id'] = $ticket['ticket_num'];
            $return_tickets[$key]['status']    = null;

            foreach ($user_tickets as $user_ticket) {
                if ($return_tickets[$key]['ticket_num'] == $user_ticket['ticket_num']) {
                    $user_last_ticket = $this->user->tickets()
                                                    ->where([['ticket_num', '=', $user_ticket['ticket_num']], ['status', '!=', null]])
                                                    ->orderBy('id', 'DESC')
                                                    ->limit(5)
                                                    ->get()
                                                    ->toArray();

                    if ($user_last_ticket) {
                        $return_tickets[$key]['status']   = $user_last_ticket[0]['status'];
                        $return_tickets[$key]['date_try'] = Carbon::createFromFormat('Y-m-d H:i:s', $user_last_ticket[0]['updated_at'])->format('d.m.Y');
                        $return_tickets[$key]['history']  = $user_last_ticket;

                        if ($user_last_ticket[0]['status'] === 'failed') {
                            $return_tickets[$key]['right_answers_count'] = $user_last_ticket[0]['right_answers_count'];
                            $return_tickets[$key]['all_count']           = $user_last_ticket[0]['answers_count'];
                        }
                    }
                }
            }
        }

        return $return_tickets;
    }
}

/**
 * Class TicketException
 * @package App\Services\Tickets
 */
class TicketException extends \ErrorException {}