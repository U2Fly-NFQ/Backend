<?php

namespace App\Mapper;

use App\Entity\Discount;
use App\Request\AddDiscountRequest;

class DiscountMapper
{
    public function mapper(AddDiscountRequest $addDiscountRequest): Discount
    {
        $discount = new Discount();
        $discount->setName($addDiscountRequest->getName());
        $discount->setPercent($addDiscountRequest->getPercent());

        return $discount;
    }
}
