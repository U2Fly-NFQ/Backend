<?php

namespace App\Tests\Entity;

use App\Entity\SeatType;
use PHPUnit\Framework\TestCase;

class SeatTypeTest extends TestCase
{
    public function testGetId()
    {
        $seatType = new SeatType();
        $seatType->setId(1);
        $result = $seatType->getId();

        $this->assertEquals(1, $result);
    }
}
