<?php

namespace App\Transformer;

use App\Constant\DatetimeConstant;
use App\Entity\FlightSeatType;
use App\Entity\SeatType;

class FlightSeatTypeTransformer extends AbstractTransformer
{
    public function toArray(FlightSeatType $flightSeatTypeSeatType): array
    {
        $result['id'] = $flightSeatTypeSeatType->getSeatType()->getId();
        $result['name'] = $flightSeatTypeSeatType->getSeatType()->getName();
        $result['price'] = $flightSeatTypeSeatType->getPrice();
        $result['seatAvailable'] = $flightSeatTypeSeatType->getSeatAvailable();
        $result['discount'] = $flightSeatTypeSeatType->getDiscount();
        return $result;
    }
}
