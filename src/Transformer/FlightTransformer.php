<?php

namespace App\Transformer;

use App\Entity\Car;
use App\Entity\Flight;
use App\Traits\TransferTrait;

class FlightTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'code', 'arrival', 'departure', 'duration'];
    const AIRLINE_ATTRIBUTE = ['id', 'name', 'icao'];

    use TransferTrait;

    public function toArrayList(array $flights): array
    {
        $flightList = [];
        foreach ($flights as $flight) {
            $flightList[] = $this->toArray($flight);
        }

        return $flightList;
    }

    public function toArray(Flight $flight): array
    {

        $result = $this->transform($flight, self::BASE_ATTRIBUTE);

        $result['startTime'] = $flight->getStartTime()->format('Y-m-d H:i:s');
        $result['airline'] = $this->transform($flight->getAirplane()->getAirline(), self::AIRLINE_ATTRIBUTE);

        return $result;
    }
}
