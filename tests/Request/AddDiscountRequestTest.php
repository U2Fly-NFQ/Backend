<?php

namespace App\Tests\Request;

use App\Request\AddDiscountRequest;
use PHPUnit\Framework\TestCase;

class AddDiscountRequestTest extends TestCase
{
    public function testGetName()
    {
        $addDiscountRequest = new AddDiscountRequest();
        $addDiscountRequest->setName('new year');
        $result = $addDiscountRequest->getName();

        $this->assertEquals('new year', $result);
    }

    public function testGetPercent()
    {
        $addDiscountRequest = new AddDiscountRequest();
        $addDiscountRequest->setPercent(1.2);
        $result = $addDiscountRequest->getPercent();

        $this->assertEquals(1.2, $result);
    }
}
