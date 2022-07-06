<?php

namespace App\Mapper;

use App\Entity\Account;
use App\Entity\Rating;
use App\Repository\AccountRepository;
use App\Repository\AirlineRepository;
use App\Repository\AirplaneRepository;
use App\Repository\FlightRepository;
use App\Request\RateRequest\AddRateRequest;
use Exception;
use Symfony\Component\Security\Core\User\UserInterface;

class AddRateRequestMapper
{
    private FlightRepository $flightRepository;
    private AirlineRepository $airlineRepository;
    private AccountRepository $accountRepository;

    /**
     * @param FlightRepository $flightRepository
     * @param AirplaneRepository $airplaneRepository
     */
    public function __construct(
        FlightRepository $flightRepository,
        AirlineRepository $airlineRepository,
        AccountRepository $accountRepository
    ) {
        $this->flightRepository = $flightRepository;
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
        $flight = $this->flightRepository->find($addRateRequest->getFlightId());
        $airline = $this->airlineRepository->find($addRateRequest->getAirlineId());
        $account = $this->accountRepository->find($addRateRequest->getAccountId());
        if ($flight ==  null || $airline == null || $account == null) {
            throw new Exception();
        }
        $rating->setFlight($flight);
        $rating->setAirline($airline);
        $rating->setAccount($account);
        $rating->setRate($addRateRequest->getRate());
        if ($addRateRequest->getComment()) {
            $rating->setComment($addRateRequest->getComment());
        }

        return $rating;
    }
}
