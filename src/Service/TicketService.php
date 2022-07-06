<?php

namespace App\Service;

use App\Constant\ErrorsConstant;
use App\Constant\FlightConstant;
use App\Entity\AbstractEntity;
use App\Entity\Flight;
use App\Entity\SeatType;
use App\Entity\Ticket;
use App\Mapper\AddTicketRequestToTicket;
use App\Mapper\TicketArrayToTicket;
use App\Repository\AirplaneSeatTypeRepository;
use App\Repository\TicketRepository;
use App\Request\AddTicketRequest;
use App\Request\TicketRequest;
use App\Traits\DateTimeTrait;
use App\Transformer\TicketTransformer;
use DateTime;
use Exception;

class TicketService
{
    use DateTimeTrait;

    private TicketRepository $ticketRepository;
    private AddTicketRequest $addTicketRequest;
    private AddTicketRequestToTicket $addTicketRequestToTicket;
    private TicketTransformer $ticketTransformer;
    private AirplaneSeatTypeRepository $airplaneSeatTypeRepository;
    private TicketArrayToTicket $ticketArrayToTicket;

    public function __construct(
        TicketRepository           $ticketRepository,
        AddTicketRequest           $addTicketRequest,
        AddTicketRequestToTicket   $addTicketRequestToTicket,
        TicketTransformer          $ticketTransformer,
        AirplaneSeatTypeRepository $airplaneSeatTypeRepository,
        TicketArrayToTicket        $ticketArrayToTicket
    )
    {
        $this->ticketRepository = $ticketRepository;
        $this->addTicketRequest = $addTicketRequest;
        $this->addTicketRequestToTicket = $addTicketRequestToTicket;
        $this->ticketTransformer = $ticketTransformer;
        $this->airplaneSeatTypeRepository = $airplaneSeatTypeRepository;
        $this->ticketArrayToTicket = $ticketArrayToTicket;
    }

    /**
     * @param AddTicketRequest $addTicketRequest
     * @return AbstractEntity
     */
    public function add(AddTicketRequest $addTicketRequest): Ticket
    {
        $ticket = $this->addTicketRequestToTicket->mapper($addTicketRequest);
        return $this->ticketRepository->create($ticket, true);
    }

    public function addByArrayData(array $metadata)
    {
        $ticket = $this->ticketArrayToTicket->mapper($metadata);

        return $this->ticketRepository->create($ticket, true);
    }

    /**
     * @param TicketRequest $ticketRequest
     * @return array
     */
    public function findAll(TicketRequest $ticketRequest)
    {
        $ticket = $this->ticketRepository->getAll($ticketRequest);

        return $this->ticketTransformer->toArrayList($ticket);
    }

    /**
     * @param Ticket $ticket
     * @return bool
     * @throws Exception
     */
    public function cancel(Ticket $ticket): bool
    {
        $ticketFlight = $ticket->getTicketFlights();
        $flight = $ticketFlight[0];
        if (!$flight->isIsRefund() || $ticket->getCancelAt()) {
            throw new Exception(ErrorsConstant::TICKET_NOT_REFUNDABLE);
        }
        $today = new DateTime();
        $timeDifference = $this->dateSubtract($today, $flight->getStartTime());
        if ($this->secondToHours($timeDifference) < FlightConstant::LIMIT_TIME_REFUND) {
            throw new Exception(ErrorsConstant::TICKET_NOT_REFUNDABLE);
        }
        $ticket->setCancelAt($today);
        $this->updateAvailableSeats($flight, $ticket->getSeatType(), -1);

        $this->ticketRepository->update($ticket, true);

        return true;
    }

    /**
     * @param Flight $flight
     * @param SeatType $seatType
     * @param int $change
     * @return bool
     */
}
