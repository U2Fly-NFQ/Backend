<?php

namespace App\Mapper;

use App\Entity\Discount;
use App\Request\AddDiscountRequest;
use App\Request\DiscountRequest\AbstractDiscountRequest;
use App\Request\DiscountRequest\UpdateDiscountRequest;

class DiscountMapper
{
    public function mapper(AddDiscountRequest $addDiscountRequest): Discount
    {
        $discount = new Discount();
        $discount->setName($addDiscountRequest->getName());
        $discount->setPercent($addDiscountRequest->getPercent());

        return $discount;
    }

    public function updateMapper(array $requestBody, Discount $discount): Discount
    {
        foreach ($requestBody as $key => $value){
            $setter = 'set' . ucfirst($key);
            if (!method_exists($discount, $setter)) {
                continue;
            }
            $discount->{$setter}($value);
        }

        return $discount;
    }
}
