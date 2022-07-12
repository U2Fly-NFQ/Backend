<?php

namespace App\Tests\Service;

use App\Entity\Discount;
use App\Mapper\DiscountMapper;
use App\Repository\DiscountRepository;
use App\Request\AddDiscountRequest;
use App\Request\DiscountRequest\PatchDiscountRequest;
use App\Service\DiscountService;
use PHPUnit\Framework\TestCase;

class DiscountServiceTest extends TestCase
{
    public function testAdd()
    {
        $addDiscountRequest = $this->getMockBuilder(AddDiscountRequest::class)->disableOriginalConstructor()->getMock();
        $discountService = $this->createDiscountService();
        $result = $discountService->add($addDiscountRequest);

        $this->assertTrue($result);
    }

    public function testPatch()
    {
        $discount = $this->getMockBuilder(Discount::class)->disableOriginalConstructor()->getMock();
        $patchDiscountRequest = $this->getMockBuilder(PatchDiscountRequest::class)->disableOriginalConstructor()->getMock();
        $discountService = $this->createDiscountService();
        $result = $discountService->patch($patchDiscountRequest, $discount);

        $this->assertTrue($result);
    }

    public function createDiscountService(): DiscountService
    {
        $discountRepository = $this->getMockBuilder(DiscountRepository::class)->disableOriginalConstructor()->getMock();
        $discountMapper = $this->getMockBuilder(DiscountMapper::class)->disableOriginalConstructor()->getMock();

        return new DiscountService($discountRepository,$discountMapper);
    }
}
