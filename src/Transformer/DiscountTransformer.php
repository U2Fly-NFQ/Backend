<?php

namespace App\Transformer;

use App\Constant\DatetimeConstant;
use App\Entity\Discount;

class DiscountTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'name', 'percent'];

    public function toArray(Discount $discount): array
    {
        $result = $this->transform($discount, self::BASE_ATTRIBUTE);
        $result['createdAt'] = $discount->getCreatedAt()->format(DatetimeConstant::DATETIME_DEFAULT);
        if(!empty($discount->getUpdatedAt())){
            $result['updatedAt'] = $discount->getUpdatedAt()->format(DatetimeConstant::DATETIME_DEFAULT);
        }

        return $result;
    }
}
