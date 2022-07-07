<?php

namespace App\Transformer;

use App\Constant\DatetimeConstant;
use App\Entity\FlightSeatType;
use App\Entity\SeatType;

class AirplaneSeatTypeTransformer extends AbstractTransformer
{
    public function toArray(FlightSeatType $airplaneSeatType): array
    {
        $result['id'] = $airplaneSeatType->getSeatType()->getId();
        $result['name'] = $airplaneSeatType->getSeatType()->getName();
        $result['price'] = $airplaneSeatType->getPrice();
        $result['seatAvailable'] = $airplaneSeatType->getSeatAvailable();
        $result['discount'] = $airplaneSeatType->getDiscount();
        return $result;
    }
}
