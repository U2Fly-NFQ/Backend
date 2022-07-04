<?php

namespace App\Mapper;

use App\Entity\Discount;
use App\Request\AddDiscountRequest;
use App\Request\DiscountRequest\AbstractDiscountRequest;
use App\Request\DiscountRequest\PatchDiscountRequest;

class DiscountMapper
{
    public function mapper(AddDiscountRequest $addDiscountRequest): Discount
    {
        $discount = new Discount();
        $discount->setName($addDiscountRequest->getName());
        $discount->setPercent($addDiscountRequest->getPercent());

        return $discount;
    }

    public function patchMapper(PatchDiscountRequest $patchDiscountRequest, Discount $discount): Discount
    {
        if ($patchDiscountRequest->getName()) {
            $discount->setName($patchDiscountRequest->getName());
        }
        if ($patchDiscountRequest->getPercent()) {
            $discount->setPercent($patchDiscountRequest->getPercent());
        }

        return $discount;
    }
}
