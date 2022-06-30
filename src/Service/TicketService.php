<?php

namespace App\Service;

use App\Mapper\AddTicketRequestToTicket;
use App\Repository\TicketRepository;
use App\Request\AddTicketRequest;
use App\Request\TicketRequest;
use App\Transformer\TicketTransformer;

class TicketService
{
    private TicketRepository $ticketRepository;
    private AddTicketRequest $addTicketRequest;
    private AddTicketRequestToTicket $addTicketRequestToTicket;
    private TicketTransformer $ticketTransformer;

    public function __construct(
        TicketRepository $ticketRepository,
        AddTicketRequest $addTicketRequest,
        AddTicketRequestToTicket $addTicketRequestToTicket,
        TicketTransformer $ticketTransformer
    ) {
        $this->ticketRepository = $ticketRepository;
        $this->addTicketRequest = $addTicketRequest;
        $this->addTicketRequestToTicket = $addTicketRequestToTicket;
        $this->ticketTransformer = $ticketTransformer;
    }

    public function add(AddTicketRequest $addTicketRequest)
    {
        $ticket = $this->addTicketRequestToTicket->mapper($addTicketRequest);
        $this->ticketRepository->add($ticket, true);

        return $ticket;
    }

    public function findAll(TicketRequest $ticketRequest)
    {
        $ticket = $this->ticketRepository->filter($ticketRequest);
        return $this->ticketTransformer->toArrayList($ticket);
    }
}
