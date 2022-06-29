<?php

namespace App\Transformer;

use App\Constant\DateFormatConstant;
use App\Entity\Airplane;

class AirplaneTransformer
{
    public function objectToArray(Airplane $airplane): array
    {
        $airline = $airplane->getAirline();

        return [
            'airplaneId' => $airplane->getId(),
            'airplaneName' => $airplane->getName(),
            'airlineName' => $airline->getName(),
            'createdAt' => $airplane->getCreatedAt()->format(date(DateFormatConstant::DATETIME_FORMAT)),
            'updateAt' => $airplane->getUpdatedAt()->format(date(DateFormatConstant::DATETIME_FORMAT))
        ];
    }
}
