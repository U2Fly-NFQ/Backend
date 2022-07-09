<?php

namespace App\Event;

use App\Entity\Ticket;

class BookingEvent
{

    public function __construct(Ticket $ticket)
    {
    }
}