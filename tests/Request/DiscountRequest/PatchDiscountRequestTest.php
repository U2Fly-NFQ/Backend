<?php

namespace App\Tests\Request\DiscountRequest;

use App\Request\DiscountRequest\PatchDiscountRequest;
use PHPUnit\Framework\TestCase;

class PatchDiscountRequestTest extends TestCase
{
    public function testGetName()
    {
        $patchDiscountRequest = new PatchDiscountRequest();
        $patchDiscountRequest->setName('new year');
        $result = $patchDiscountRequest->getName();

        $this->assertEquals('new year', $result);
    }

    public function testGetPercent()
    {
        $patchDiscountRequest = new PatchDiscountRequest();
        $patchDiscountRequest->setPercent(5);
        $result = $patchDiscountRequest->getPercent();

        $this->assertEquals(5, $result);
    }
}
