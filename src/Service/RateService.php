<?php

namespace App\Service;

use App\Entity\Rating;
use App\Mapper\AddRateRequestMapper;
use App\Repository\AirlineRepository;
use App\Repository\RatingRepository;
use App\Request\RateRequest\AddRateRequest;
use Symfony\Component\Security\Core\User\UserInterface;

class RateService
{
    private AddRateRequestMapper $addRateRequestMapper;
    private RatingRepository $ratingRepository;
    private AirlineRepository $airlineRepository;

    /**
     * @param AddRateRequestMapper $addRateRequestMapper
     * @param RatingRepository $ratingRepository
     * @param AirlineRepository $airlineRepository
     */
    public function __construct(AddRateRequestMapper $addRateRequestMapper, RatingRepository $ratingRepository, AirlineRepository $airlineRepository)
    {
        $this->addRateRequestMapper = $addRateRequestMapper;
        $this->ratingRepository = $ratingRepository;
        $this->airlineRepository = $airlineRepository;
    }

    /**
     * @param AddRateRequest $addRateRequest
     * @return void
     * @throws \Exception
     */
    public function add(AddRateRequest $addRateRequest): bool
    {
        $rating = $this->addRateRequestMapper->mapper($addRateRequest);
        $this->ratingRepository->add($rating, true);
        $this->updateAirlineRate($rating);

        return true;
    }

    /**
     * @param Rating $rating
     * @return void
     */
    private function updateAirlineRate(Rating $rating): void
    {
        $airline = $rating->getAirline();
        $rate = $rating->getRate();
        $airlineRate = $airline->getRating();
        $numberRating = $airline->getNumberRating();
        $newRate = ($rate + $airlineRate * $numberRating) / ($numberRating + 1);
        $airline->setRating($newRate);
        $this->airlineRepository->add($airline, true);
    }
}
