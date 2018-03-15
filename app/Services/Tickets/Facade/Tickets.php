<?php

namespace App\Services\Tickets\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed getTickets()
 *
 * @see \App\Services\Tickets\Tickets
 */
class Tickets extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Tickets';
    }
}