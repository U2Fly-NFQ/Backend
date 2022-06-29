<?php

namespace App\Transformer;

use App\Constant\DateFormatConstant;
use App\Entity\Airplane;

class AirplaneTransformer
{
    /**
     * @param Airplane $airplane
     * @return array
     */
    public function objectToArray(Airplane $airplane): array
    {
        $airline = $airplane->getAirline();

        return [
            'airplaneId' => $airplane->getId(),
            'airplaneName' => $airplane->getName(),
            'airlineName' => $airline->getName(),
            'createdAt' => $airplane->getCreatedAt()->format(date(DATE_ATOM)),
            'updateAt' => $airplane->getUpdatedAt()->format(date(DATE_ATOM))
        ];
    }
}
