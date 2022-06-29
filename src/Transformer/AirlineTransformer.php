<?php

namespace App\Transformer;

use App\Entity\Airline;

class AirlineTransformer
{
    /**
     * @param Airline $airline
     * @return array
     */
    public function objectToArray(Airline $airline): array
    {
        return [
            'airlineId' => $airline->getId(),
            'airlineName' => $airline->getName(),
            'airlineIcao' => $airline->getIcao(),
            'createdDate' => $airline->getUpdatedAt()->format(date(DATE_ATOM)),
            'updateDate' => $airline->getUpdatedAt()->format(date(DATE_ATOM))
        ];
    }
}
