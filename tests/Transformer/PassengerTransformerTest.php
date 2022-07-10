<?php

namespace App\Tests\Transformer;

use App\Entity\Account;
use App\Entity\Passenger;
use App\Traits\DateTimeTrait;
use App\Transformer\PassengerTransformer;
use DateTime;
use JetBrains\PhpStorm\ArrayShape;
use PHPUnit\Framework\TestCase;

class PassengerTransformerTest extends TestCase
{
    public function testToArray()
    {
        $date = new DateTime('2022-07-09 00:00:00');
        $account = $this->getMockBuilder(Account::class)->disableOriginalConstructor()->getMock();
        $passenger = $this->getMockBuilder(Passenger::class)->disableOriginalConstructor()->getMock();
        $passenger->expects($this->any())->method('getBirthday')->willReturn($date);
        $passenger->expects($this->any())->method('getAccount')->willReturn($account);
        $passengerTransformer = new PassengerTransformer();
        $result = $passengerTransformer->toArray($passenger);

        $this->assertIsArray($result);
    }
}
