<?php

namespace App\Transformer;

use App\Constant\DatetimeConstant;
use App\Entity\Passenger;
use App\Entity\Ticket;
use App\Repository\SeatTypeRepository;
use App\Repository\TicketFlightRepository;
use App\Traits\DateTimeTrait;
use DateTime;

class TicketTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'passenger', 'totalPrice', 'ticketOwner', 'paymentId'];

    use DateTimeTrait;

    private PassengerTransformer $passengerTransformer;
    private FlightTransformer $flightTransformer;
    private TicketFlightTransformer $ticketFlightTransformer;
    private TicketFlightRepository $ticketFlightRepository;
    private SeatTypeRepository $seatTypeRepository;

    public function __construct(
        PassengerTransformer    $passengerTransformer,
        FlightTransformer       $flightTransformer,
        TicketFlightTransformer $ticketFlightTransformer,
        TicketFlightRepository  $ticketFlightRepository,
        SeatTypeRepository      $seatTypeRepository
    )
    {
        $this->passengerTransformer = $passengerTransformer;
        $this->flightTransformer = $flightTransformer;
        $this->ticketFlightTransformer = $ticketFlightTransformer;
        $this->ticketFlightRepository = $ticketFlightRepository;
        $this->seatTypeRepository = $seatTypeRepository;
    }

    public function toArrayList(array $tickets): array
    {
        $ticketList = [];
        foreach ($tickets as $ticket) {
            $ticketList[] = $this->toArray($ticket);
        }

        return $ticketList;
    }

    public function toArray(Ticket $ticket)
    {
        $ticketArray = $this->transform($ticket, self::BASE_ATTRIBUTE);
        $ticketArray['id'] = $ticket->getId();
        $ticketArray['email'] = $ticket->getPassenger()->getAccount()->getEmail();
        $ticketArray['passenger'] = $this->passengerTransformer->toArray($ticket->getPassenger());
        $ticket->getDiscount() != null ? $ticketArray['discount'] = $ticket->getDiscount()->getPercent() : $ticketArray['discount'] = 0;
        $ticketArray['seatType'] = $ticket->getSeatType()->getName();
        $ticketArray['createdAt'] = $ticket->getCreatedAt()->format(DatetimeConstant::DATETIME_DEFAULT);
        $ticketArray['status'] = $ticket->getStatus();
        if ($ticket->getUpdatedAt()) {
            $ticketArray['updatedAt'] = $ticket->getUpdatedAt()->format(DatetimeConstant::DATETIME_DEFAULT);
        }
        $ticketFlights = $this->ticketFlightRepository->findBy(['ticket' => $ticketArray['id']]);
        $ticketArray['flights'] = $this->getFlights($ticketFlights);

        return $ticketArray;
    }

    private function getFlights($ticketFlights)
    {
        $flightArray = [];
        foreach ($ticketFlights as $index => $ticketFlight) {
            $flight = $ticketFlight->getFlight();
            $flightArray[] = $this->flightTransformer->toArray($flight);
            $flightArray[$index]['ticketFlight'] = $this->ticketFlightTransformer->toArray($ticketFlight);
        }

        return $flightArray;
    }

}


