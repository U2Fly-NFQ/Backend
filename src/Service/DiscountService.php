<?php

namespace App\Service;

use App\Mapper\DiscountMapper;
use App\Repository\DiscountRepository;
use App\Request\AddDiscountRequest;

class DiscountService
{
    private DiscountRepository $discountRepository;
    private DiscountMapper $discountMapper;

    /**
     * @param DiscountRepository $discountRepository
     * @param DiscountMapper $discountMapper
     */
    public function __construct(DiscountRepository $discountRepository, DiscountMapper $discountMapper)
    {
        $this->discountRepository = $discountRepository;
        $this->discountMapper = $discountMapper;
    }

    public function add(AddDiscountRequest $addDiscountRequest): bool
    {
        $discount = $this->discountMapper->mapper($addDiscountRequest);
        $this->discountRepository->add($discount, true);

        return true;
    }
}
