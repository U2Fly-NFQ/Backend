<?php

namespace App\Mapper;

use App\Entity\Account;
use App\Entity\Ticket;
use App\Repository\AccountRepository;
use App\Repository\DiscountRepository;
use App\Repository\FlightRepository;
use App\Repository\PassengerRepository;
use App\Repository\SeatTypeRepository;
use App\Repository\TicketRepository;
use App\Request\AddTicketRequest;
use Symfony\Component\Security\Core\Security;

class AddTicketRequestToTicket
{
    private PassengerRepository $passengerRepository;
    private DiscountRepository $discountRepository;
    private SeatTypeRepository $seatTypeRepository;

    public function __construct(
        PassengerRepository $passengerRepository,
        DiscountRepository $discountRepository,
        SeatTypeRepository $seatTypeRepository
    ) {
        $this->passengerRepository = $passengerRepository;
        $this->discountRepository = $discountRepository;
        $this->seatTypeRepository = $seatTypeRepository;
    }

    public function mapper(AddTicketRequest $addTicketRequest): Ticket
    {
        $ticket = new Ticket();
        $passenger = $this->passengerRepository->find($addTicketRequest->getPassengerId());
        $discount = $this->discountRepository->find($addTicketRequest->getDiscountId());
        $seatType = $this->seatTypeRepository->find($addTicketRequest->getSeatTypeId());
        $ticketOwner = $addTicketRequest->getTicketOwner();
        $totalPrice = $addTicketRequest->getTotalPrice();

        $ticket->setPassenger($passenger);
        $ticket->setDiscount($discount);
        $ticket->setSeatType($seatType);
        $ticket->setTicketOwner($ticketOwner);
        $ticket->setTotalPrice($totalPrice);

        return $ticket;
    }
}
