<?php

namespace App\Service;

use App\Constant\DatetimeConstant;
use App\Constant\ErrorsConstant;
use App\Entity\Ticket;
use App\Mapper\AddTicketRequestToTicket;
use App\Repository\TicketRepository;
use App\Request\AddTicketRequest;
use App\Request\TicketRequest;
use App\Traits\DateTimeTrait;
use App\Transformer\TicketTransformer;
use DateTime;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class TicketService
{
    use DateTimeTrait;

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
        $ticket = $this->ticketRepository->getAll($ticketRequest);
        return $this->ticketTransformer->toArrayList($ticket);
    }

    public function cancel(Ticket $ticket): bool
    {
        $flight = $ticket->getFlight();
        if(!$flight->isIsRefund() || $ticket->getCancelAt()){
            throw new Exception(ErrorsConstant::TICKET_NOT_REFUNDABLE);
        }
        $today = new DateTime();
        $diff = $this->dateSubtract($today, $flight->getStartTime());
        if($this->secondToHours($diff) <  2){
            throw new Exception(ErrorsConstant::TICKET_NOT_REFUNDABLE);
        }
        $ticket->setCancelAt($today);
        $this->ticketRepository->update($ticket, true);

        return True;
    }


}
