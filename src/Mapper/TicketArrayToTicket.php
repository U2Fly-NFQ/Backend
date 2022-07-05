<?php

namespace App\Mapper;

use App\Entity\Ticket;
use App\Repository\DiscountRepository;
use App\Repository\FlightRepository;
use App\Repository\PassengerRepository;
use App\Repository\SeatTypeRepository;

class TicketArrayToTicket
{
    private PassengerRepository $passengerRepository;
    private FlightRepository $flightRepository;
    private DiscountRepository $discountRepository;
    private SeatTypeRepository $seatTypeRepository;

    public function __construct(
        PassengerRepository $passengerRepository,
        FlightRepository $flightRepository,
        DiscountRepository $discountRepository,
        SeatTypeRepository $seatTypeRepository
    )
    {
        $this->passengerRepository = $passengerRepository;
        $this->flightRepository = $flightRepository;
        $this->discountRepository = $discountRepository;
        $this->seatTypeRepository = $seatTypeRepository;
    }

    public function mapper($metadata)
    {
        $ticket = new Ticket();
        $passenger = $this->passengerRepository->find($metadata['passengerId']);
        $flight = $this->flightRepository->find($metadata['discountId']);
        $discount = $this->discountRepository->find($metadata['flightId']);
        $seatType = $this->seatTypeRepository->find($metadata['seatTypeId']);
        $ticketOwner = $metadata['ticketOwner'];
        $totalPrice = $metadata['totalPrice'];

        $ticket->setPassenger($passenger);
        $ticket->setFlight($flight);
        $ticket->setDiscount($discount);
        $ticket->setSeatType($seatType);
        $ticket->setTicketOwner($ticketOwner);
        $ticket->setTotalPrice($totalPrice);

        return $ticket;
    }
}
