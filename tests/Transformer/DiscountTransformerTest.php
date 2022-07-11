<?php

namespace App\Tests\Transformer;

use App\Entity\Discount;
use App\Transformer\DiscountTransformer;
use DateTime;
use PHPUnit\Framework\TestCase;

class DiscountTransformerTest extends TestCase
{
    public function testToArray()
    {
        $date = new DateTime('2022-07-09 00:00:00');
        $discount = $this->getMockBuilder(Discount::class)->disableOriginalConstructor()->getMock();
        $discount->expects($this->any())->method('getUpdatedAt')->willReturn($date);
        $discount->expects($this->any())->method('getCreatedAt')->willReturn($date);

        $discountTransformer = new DiscountTransformer();
        $result = $discountTransformer->toArray($discount);

        $this->assertIsArray($result);
    }

    public function testToArrayList()
    {
        $date = new DateTime('2022-07-09 00:00:00');
        $discount = $this->getMockBuilder(Discount::class)->disableOriginalConstructor()->getMock();
        $discount->expects($this->any())->method('getUpdatedAt')->willReturn($date);
        $discount->expects($this->any())->method('getCreatedAt')->willReturn($date);

        $discountTransformer = new DiscountTransformer();
        $result = $discountTransformer->toArrayList([$discount]);

        $this->assertIsArray($result);
    }
}
