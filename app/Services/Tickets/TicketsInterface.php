<?php

namespace App\Services\Tickets;

/**
 * Interface TicketsInterface
 * @package App\Services\Tickets
 */
interface TicketsInterface
{
    /**
     * @return mixed
     */
    public function getTickets();

    /**
     * @param int $ticket
     *
     * @return mixed
     */
    public function getTicketData(int $ticket);

    /**
     * @return mixed
     */
    public function getInfo();

    /**
     * @return mixed
     */
    public function getAnalysis();
}