<?php

namespace App\Service;

use App\Constant\ErrorsConstant;
use App\Constant\FlightConstant;
use App\Entity\Flight;
use App\Entity\SeatType;
use App\Entity\Ticket;
use App\Mapper\AddTicketRequestToTicket;
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

    public function __construct(
        TicketRepository $ticketRepository,
        AddTicketRequest $addTicketRequest,
        AddTicketRequestToTicket $addTicketRequestToTicket,
        TicketTransformer $ticketTransformer,
        AirplaneSeatTypeRepository $airplaneSeatTypeRepository
    ) {
        $this->ticketRepository = $ticketRepository;
        $this->addTicketRequest = $addTicketRequest;
        $this->addTicketRequestToTicket = $addTicketRequestToTicket;
        $this->ticketTransformer = $ticketTransformer;
        $this->airplaneSeatTypeRepository = $airplaneSeatTypeRepository;
    }

    /**
     * @param AddTicketRequest $addTicketRequest
     * @return Ticket
     */
    public function add(AddTicketRequest $addTicketRequest)
    {
        $ticket = $this->addTicketRequestToTicket->mapper($addTicketRequest);
        $this->ticketRepository->add($ticket, true);

        return $ticket;
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
        $flight = $ticket->getFlight();
        if (!$flight->isIsRefund() || $ticket->getCancelAt()) {
            throw new Exception(ErrorsConstant::TICKET_NOT_REFUNDABLE);
        }
        $today = new DateTime();
        $timeDifference = $this->dateSubtract($today, $flight->getStartTime());
        if ($this->secondToHours($timeDifference) <  FlightConstant::LIMIT_TIME_REFUND) {
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
    private function updateAvailableSeats(Flight $flight, SeatType $seatType, int $change): bool
    {
        $airplane = $flight->getAirplane();
        $seatTypeId = $seatType->getId();
        $airplaneId = $airplane->getId();

        $query = ['airplane' => $airplaneId, 'seatType' => $seatTypeId];
        $airplaneSeatTypes = $this->airplaneSeatTypeRepository->findBy($query);
        $airplaneSeatType = array_pop($airplaneSeatTypes);

        $seatAvailable = $airplaneSeatType->getSeatAvailable();
        $newSeatAvailable = $seatAvailable + $change;
        $airplaneSeatType->setSeatAvailable($newSeatAvailable);
        $this->airplaneSeatTypeRepository->add($airplaneSeatType, true);

        return true;
    }
}
