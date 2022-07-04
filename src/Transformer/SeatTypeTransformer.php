<?php

namespace App\Transformer;

use App\Constant\DatetimeConstant;
use App\Entity\SeatType;

class SeatTypeTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'name'];

    public function toArray(SeatType $seatType): array
    {
        $result = $this->transform($seatType, self::BASE_ATTRIBUTE);
        $result['createdAt'] = $seatType->getCreatedAt()->format(DatetimeConstant::DATETIME_DEFAULT);
        if (!empty($seatType->getUpdatedAt())) {
            $result['updatedAt'] = $seatType->getUpdatedAt()->format(DatetimeConstant::DATETIME_DEFAULT);
        }

        return $result;
    }
}
