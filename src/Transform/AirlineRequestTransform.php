<?php

namespace App\Transform;

use App\Entity\Airline;
use App\Request\AirlineRequest;

class AirlineRequestTransform
{
    /**
     * @param AirlineRequest $airlineRequest
     * @return Airline
     */
    public function airlineRequestToAirline(AirlineRequest $airlineRequest): Airline
    {
        $airline = new Airline();
        $airline->setIcao($airlineRequest->getIcao());
        $airline->setName($airlineRequest->getName());

        return $airline;
    }
}
