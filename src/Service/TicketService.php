<?php

namespace App\Service;

use App\Constant\DatetimeConstant;
use App\Constant\ErrorsConstant;
use App\Constant\FlightConstant;
use App\Constant\TicketStatusConstant;
use App\Entity\AbstractEntity;
use App\Entity\Flight;
use App\Entity\SeatType;
use App\Entity\Ticket;
use App\Mapper\AddTicketRequestToTicket;
use App\Mapper\TicketArrayToTicket;
use App\Repository\AirplaneSeatTypeRepository;
use App\Repository\TicketRepository;
use App\Request\AddTicketRequest;
use App\Request\TicketRequest\ListTicketRequest;
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
    private AirplaneSeatTypeService $airplaneSeatTypeService;

    public function __construct(
        TicketRepository $ticketRepository,
        AddTicketRequest $addTicketRequest,
        AddTicketRequestToTicket $addTicketRequestToTicket,
        TicketTransformer $ticketTransformer,
        AirplaneSeatTypeRepository $airplaneSeatTypeRepository,
        TicketArrayToTicket $ticketArrayToTicket,
        AirplaneSeatTypeService $airplaneSeatTypeService
    ) {
        $this->ticketRepository = $ticketRepository;
        $this->addTicketRequest = $addTicketRequest;
        $this->addTicketRequestToTicket = $addTicketRequestToTicket;
        $this->ticketTransformer = $ticketTransformer;
        $this->airplaneSeatTypeRepository = $airplaneSeatTypeRepository;
        $this->ticketArrayToTicket = $ticketArrayToTicket;
        $this->airplaneSeatTypeService = $airplaneSeatTypeService;
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

    public function addByArrayData(array $metadata, string $paymentId)
    {
        $ticket = $this->ticketArrayToTicket->mapper($metadata,$paymentId);

        return $this->ticketRepository->create($ticket, true);
    }

    /**
     * @param ListTicketRequest $ticketRequest
     * @return array
     */
    public function findAll(ListTicketRequest $listTicketRequest): array
    {
        $param['passenger'] = $listTicketRequest->getPassenger();
        $param['effectiveness'] = $listTicketRequest->isEffectiveness();
        $now = new DateTime();
        $date = $now->format(DatetimeConstant::FLIGHT_DATE);
        $time = $now->format(DatetimeConstant::TIME_DEFAULT);
        $param['date'] = $date;
        $param['time'] = $time;
        $queryTickets = $this->ticketRepository->getAll($param);

        return $this->ticketTransformer->toArrayList($queryTickets);
    }

    /**
     * @param Ticket $ticket
     * @return bool
     * @throws Exception
     */
    public function cancel(Ticket $ticket): bool
    {
        $ticketFlights = $ticket->getTicketFlights();
        $flight = $ticketFlights[0]->getFlight();
        if (!$flight->getIsRefund() ||   $ticket->getStatus() == TicketStatusConstant::CANCEL) {
            throw new Exception(ErrorsConstant::TICKET_NOT_REFUNDABLE);
        }
        $today = new DateTime();
        $startDate = $flight->getStartDate()->format(DatetimeConstant::DATE_DEFAULT) . ' ' . $flight->getStartTime()->format(DatetimeConstant::TIME_DEFAULT);
        $startDate = new DateTime($startDate);
        $timeDifference = $this->dateSubtract($today, $startDate);
        if ($this->secondToHours($timeDifference) <  FlightConstant::LIMIT_TIME_REFUND) {
            throw new Exception(ErrorsConstant::TICKET_NOT_REFUNDABLE);
        }
        $ticket->setStatus(TicketStatusConstant::CANCEL);
        $this->airplaneSeatTypeService->updateAvailableSeats($flight, $ticket->getSeatType(), 1);
        $this->ticketRepository->update($ticket, true);

    return true;
    }
}
