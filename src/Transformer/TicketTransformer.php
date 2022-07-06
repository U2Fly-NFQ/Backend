<?php

namespace App\Transformer;

use App\Constant\DatetimeConstant;
use App\Entity\Passenger;
use App\Entity\Ticket;
use App\Traits\DateTimeTrait;

class TicketTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'passenger', 'totalPrice', 'ticketOwner'];
    const FLIGHT_ATTRIBUTE = ['arrival', 'departure', 'startTime'];

    use DateTimeTrait;

    private PassengerTransformer $passengerTransformer;
    private FlightTransformer $flightTransformer;

    public function __construct(PassengerTransformer $passengerTransformer, FlightTransformer $flightTransformer)
    {
        $this->passengerTransformer = $passengerTransformer;
        $this->flightTransformer = $flightTransformer;
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
        $ticketArray['passenger'] = $this->passengerTransformer->toArray($ticket->getPassenger());
        $ticketArray['discount'] = $ticket->getDiscount()->getId();
        $ticketArray['seatType'] = $ticket->getSeatType()->getName();
        $ticketArray['createdAt'] = $ticket->getCreatedAt()->format(DatetimeConstant::DATETIME_DEFAULT);
        if ($ticket->getUpdatedAt()) {
            $ticketArray['updatedAt'] = $ticket->getUpdatedAt()->format(DatetimeConstant::DATETIME_DEFAULT);
        }
        if ($ticket->getCancelAt()) {
            $ticketArray['cancelAt'] = $ticket->getCancelAt()->format(DatetimeConstant::DATETIME_DEFAULT);
        }
        $ticketArray['flights'] = $this->getFlights($ticket->getTicketFlights(), $ticket->getSeatType());

        return $ticketArray;
    }

    private function getFlights($ticketFlights, $seatType)
    {
        $flights = [];
        foreach ($ticketFlights as $ticketFlight) {
            $flight = $this->flightTransformer->toArray($ticketFlight->getFlight(), $seatType);
            $flights[] = $flight;
        }

        return $flights;
    }
}
