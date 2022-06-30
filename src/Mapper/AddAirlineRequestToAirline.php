<?php

namespace App\Mapper;

use App\Entity\Airline;
use App\Request\AirlineRequest;

class AddAirlineRequestToAirline
{
    /**
     * @param AirlineRequest $airlineRequest
     * @return Airline
     */
    public function mapper(AirlineRequest $airlineRequest): Airline
    {
        $airline = new Airline();
        $airline->setIcao($airlineRequest->getIcao());
        $airline->setName($airlineRequest->getName());

        return $airline;
    }
}
