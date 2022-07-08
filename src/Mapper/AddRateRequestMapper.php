<?php

namespace App\Mapper;

use App\Constant\ErrorsConstant;
use App\Entity\Account;
use App\Entity\Rating;
use App\Repository\AccountRepository;
use App\Repository\AirlineRepository;
use App\Repository\AirplaneRepository;
use App\Repository\FlightRepository;
use App\Repository\TicketFlightRepository;
use App\Request\RateRequest\AddRateRequest;
use Exception;
use Symfony\Component\Security\Core\User\UserInterface;

class AddRateRequestMapper
{
    private TicketFlightRepository $ticketFlightRepository;
    private AirlineRepository $airlineRepository;
    private AccountRepository $accountRepository;

    /**
     * @param FlightRepository $flightRepository
     * @param AirplaneRepository $airplaneRepository
     */
    public function __construct(
        TicketFlightRepository $ticketFlightRepository,
        AirlineRepository $airlineRepository,
        AccountRepository $accountRepository
    ) {
        $this->ticketFlightRepository = $ticketFlightRepository;
        $this->airlineRepository = $airlineRepository;
        $this->accountRepository = $accountRepository;
    }

    /**
     * @param AddRateRequest $addRateRequest
     * @return Rating
     * @throws Exception
     */
    public function mapper(AddRateRequest $addRateRequest): Rating
    {
        $rating = new Rating();
        $ticketFlight = $this->ticketFlightRepository->find($addRateRequest->getTicketFlightId());
        if ($ticketFlight == null) {
            throw new Exception(ErrorsConstant::TICKET_FLIGHT_NOT_FOUND);
        }
        $airline = $this->airlineRepository->find($addRateRequest->getAirlineId());
        $account = $this->accountRepository->find($addRateRequest->getAccountId());
        if ($airline == null || $account == null) {
            throw new Exception(ErrorsConstant::TICKET_OR_ACCOUNT_NOT_FOUND);
        }
        $rating->setTicketFlight($ticketFlight);
        $rating->setAirline($airline);
        $rating->setAccount($account);
        $rating->setRate($addRateRequest->getRate());
        if ($addRateRequest->getComment()) {
            $rating->setComment($addRateRequest->getComment());
        }

        return $rating;
    }
}
