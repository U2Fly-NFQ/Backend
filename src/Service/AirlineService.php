<?php

namespace App\Service;

use App\Entity\Airline;
use App\Repository\AirlineRepository;
use App\Request\AirlineRequest;
use App\Transform\AirlineRequestTransform;
use App\Transformer\AirlineTransformer;

class AirlineService
{
    private AirlineRepository $airlineRepository;
    private AirlineRequestTransform $airlineRequestTransform;

    /**
     * @param AirlineRepository $airlineRepository
     * @param AirlineRequestTransform $airlineRequestTransform
     */
    public function __construct(AirlineRepository $airlineRepository, AirlineRequestTransform $airlineRequestTransform)
    {
        $this->airlineRepository = $airlineRepository;
        $this->airlineRequestTransform = $airlineRequestTransform;
    }

    /**
     * @param AirlineRequest $airlineRequest
     * @return array
     */
    public function addAirline(AirlineRequest $airlineRequest): array
    {
        $airline = $this->airlineRequestTransform->airlineRequestToAirline($airlineRequest);
        $AirlineId = $this->airlineRepository->add($airline, true);

        return ['id' => $AirlineId];
    }
}
