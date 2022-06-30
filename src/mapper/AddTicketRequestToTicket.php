<?php

namespace App\mapper;

use App\Entity\Account;
use App\Entity\Ticket;
use App\Repository\AccountRepository;
use App\Repository\DiscountRepository;
use App\Repository\FlightRepository;
use App\Repository\SeatTypeRepository;
use App\Repository\TicketRepository;
use App\Request\AddTicketRequest;
use Symfony\Component\Security\Core\Security;

class AddTicketRequestToTicket
{
    private AccountRepository $accountRepository;
    private FlightRepository $flightRepository;
    private DiscountRepository $discountRepository;
    private SeatTypeRepository $seatTypeRepository;

    public function __construct(
        AccountRepository $accountRepository,
        FlightRepository $flightRepository,
        DiscountRepository $discountRepository,
        SeatTypeRepository $seatTypeRepository
    ) {
        $this->accountRepository = $accountRepository;
        $this->flightRepository = $flightRepository;
        $this->discountRepository = $discountRepository;
        $this->seatTypeRepository = $seatTypeRepository;
    }

    public function mapper(AddTicketRequest $addTicketRequest)
    {
        $ticket = new Ticket();
        $account = $this->accountRepository->find($addTicketRequest->getAccountId());
        $flight = $this->flightRepository->find($addTicketRequest->getFlightId());
        $discount = $this->discountRepository->find($addTicketRequest->getDiscountId());
        $seatType = $this->seatTypeRepository->find($addTicketRequest->getSeatTypeId());
        $ticket->setAccount($account)
            ->setFlight($flight)
            ->setDiscount($discount)
            ->setSeatType($seatType)
            ->setTotalPrice($addTicketRequest->getTotalPrice());

        return $ticket;
    }
}
