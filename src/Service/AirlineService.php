<?php

namespace App\Service;

use App\Mapper\AddAirlineRequestToAirline;
use App\Repository\AirlineRepository;
use App\Request\AirlineRequest;

class AirlineService
{
    private AirlineRepository $airlineRepository;
    private AddAirlineRequestToAirline $airlineRequestTransform;

    /**
     * @param AirlineRepository $airlineRepository
     * @param AddAirlineRequestToAirline $airlineRequestTransform
     */
    public function __construct(AirlineRepository $airlineRepository, AddAirlineRequestToAirline $airlineRequestTransform)
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
        $airline = $this->airlineRequestTransform->mapper($airlineRequest);
        $AirlineId = $this->airlineRepository->add($airline, true);

        return ['id' => $AirlineId];
    }
}
