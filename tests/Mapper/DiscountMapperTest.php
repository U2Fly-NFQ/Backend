<?php

namespace App\Tests\Mapper;

use App\Entity\Discount;
use App\Mapper\DiscountMapper;
use App\Repository\DiscountRepository;
use App\Request\AddDiscountRequest;
use App\Request\DiscountRequest\PatchDiscountRequest;
use PHPUnit\Framework\TestCase;

class DiscountMapperTest extends TestCase
{
    public function testMapper()
    {
        $addDiscountRequest = $this->getMockBuilder(AddDiscountRequest::class)->disableOriginalConstructor()->getMock();
        $discountMapper = new DiscountMapper();
        $result = $discountMapper->mapper($addDiscountRequest);

        $this->assertInstanceOf(Discount::class, $result);
    }

    public function testPatchMapper()
    {
        $patchDiscountRequest = $this->getMockBuilder(PatchDiscountRequest::class)->disableOriginalConstructor()->getMock();
        $patchDiscountRequest->expects($this->any())->method('getName')->willReturn('Christmas');
        $patchDiscountRequest->expects($this->any())->method('getPercent')->willReturn(0.2);
        $discount = $this->getMockBuilder(Discount::class)->disableOriginalConstructor()->getMock();
        $discountMapper = new DiscountMapper();
        $result = $discountMapper->patchMapper($patchDiscountRequest, $discount);

        $this->assertInstanceOf(Discount::class, $result);
    }
}
