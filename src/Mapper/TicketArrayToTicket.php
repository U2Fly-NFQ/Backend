<?php

namespace App\Mapper;

use App\Entity\Ticket;
use App\Repository\DiscountRepository;
use App\Repository\FlightRepository;
use App\Repository\PassengerRepository;
use App\Repository\SeatTypeRepository;
use App\Repository\TicketFlightRepository;

class TicketArrayToTicket
{
    private PassengerRepository $passengerRepository;
    private DiscountRepository $discountRepository;
    private SeatTypeRepository $seatTypeRepository;

    public function __construct(
        PassengerRepository $passengerRepository,
        FlightRepository $flightRepository,
        DiscountRepository $discountRepository,
        SeatTypeRepository $seatTypeRepository
    ) {
        $this->passengerRepository = $passengerRepository;
        $this->discountRepository = $discountRepository;
        $this->seatTypeRepository = $seatTypeRepository;
    }

    public function mapper($metadata, $paymentId)
    {
        $ticket = new Ticket();
        $passenger = $this->passengerRepository->find($metadata['passengerId']);
        $discount = $this->discountRepository->find($metadata['discountId']);
        $seatType = $this->seatTypeRepository->find($metadata['seatTypeId']);
        $ticketOwner = $metadata['ticketOwner'];
        $totalPrice = $metadata['totalPrice']/100;

        $ticket->setPassenger($passenger);
        $ticket->setDiscount($discount);
        $ticket->setSeatType($seatType);
        $ticket->setTicketOwner($ticketOwner);
        $ticket->setTotalPrice($totalPrice);
        $ticket->setPaymentId($paymentId);

        return $ticket;
    }
}
