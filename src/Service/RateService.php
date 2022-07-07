<?php

namespace App\Service;

use App\Entity\Rating;
use App\Entity\TicketFlight;
use App\Mapper\AddRateRequestMapper;
use App\Repository\AirlineRepository;
use App\Repository\RatingRepository;
use App\Repository\TicketFlightRepository;
use App\Request\RateRequest\AddRateRequest;
use Exception;
use Symfony\Component\Security\Core\User\UserInterface;

class RateService
{
    private AddRateRequestMapper $addRateRequestMapper;
    private RatingRepository $ratingRepository;
    private AirlineRepository $airlineRepository;
    private TicketFlightRepository $ticketFlightRepository;

    /**
     * @param AddRateRequestMapper $addRateRequestMapper
     * @param RatingRepository $ratingRepository
     * @param TicketFlightRepository $ticketFlightRepository
     * @param AirlineRepository $airlineRepository
     */
    public function __construct(AddRateRequestMapper $addRateRequestMapper,
                                RatingRepository $ratingRepository,
                                TicketFlightRepository $ticketFlightRepository,
                                AirlineRepository $airlineRepository)
    {
        $this->addRateRequestMapper = $addRateRequestMapper;
        $this->ratingRepository = $ratingRepository;
        $this->airlineRepository = $airlineRepository;
        $this->ticketFlightRepository = $ticketFlightRepository;
    }

    /**
     * @param AddRateRequest $addRateRequest
     * @return void
     * @throws \Exception
     */
    public function add(AddRateRequest $addRateRequest): bool
    {
        $ticketFlightId = $addRateRequest->getTicketFlightId();
        $ticketFlight = $this->ticketFlightRepository->find($ticketFlightId);
        if($ticketFlight == null){
            throw new Exception();
        }
        if($ticketFlight->isIsRating()){
            throw new Exception();
        }
        $rating = $this->addRateRequestMapper->mapper($addRateRequest);
        $this->ratingRepository->add($rating, true);
        $this->updateAirlineRate($rating);
        $this->updateTicketFlightRate($ticketFlight);

        return true;
    }

    /**
     * @param Rating $rating
     * @return bool
     */
    private function updateAirlineRate(Rating $rating): bool
    {
        $airline = $rating->getAirline();
        $rate = $rating->getRate();
        $airlineRate = $airline->getRating();
        $numberRating = $airline->getNumberRating();
        $newRate = ($rate + $airlineRate * $numberRating) / ($numberRating + 1);
        $airline->setRating($newRate);
        $airline->setNumberRating($numberRating + 1);
        $this->airlineRepository->add($airline, true);

        return true;
    }

    /**
     * @param TicketFlight $ticketFlight
     * @return bool
     */
    private function updateTicketFlightRate(TicketFlight $ticketFlight): bool
    {
        $ticketFlight->setIsRating(true);
        $this->ticketFlightRepository->add($ticketFlight, true);

        return true;
    }
}
