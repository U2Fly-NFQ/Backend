<?php

namespace App\Service;

use App\mapper\AddTicketRequestToTicket;
use App\Repository\TicketRepository;
use App\Request\AddTicketRequest;

class TicketService
{
    private TicketRepository $ticketRepository;
    private AddTicketRequest $addTicketRequest;
    private AddTicketRequestToTicket $addTicketRequestToTicket;

    public function __construct(
        TicketRepository $ticketRepository,
        AddTicketRequest $addTicketRequest,
        AddTicketRequestToTicket $addTicketRequestToTicket
    ) {
        $this->ticketRepository = $ticketRepository;
        $this->addTicketRequest = $addTicketRequest;
        $this->addTicketRequestToTicket = $addTicketRequestToTicket;
    }

    public function add(AddTicketRequest $addTicketRequest)
    {
        $ticket = $this->addTicketRequestToTicket->mapper($addTicketRequest);
        $this->ticketRepository->add($ticket, true);

        return $ticket;
    }
}
