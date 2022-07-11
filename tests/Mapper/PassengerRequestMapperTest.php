<?php

namespace App\Tests\Mapper;

use App\Entity\Account;
use App\Entity\Passenger;
use App\Mapper\PassengerRequestMapper;
use App\Request\PassengerRequest\AddPassengerRequest;
use phpDocumentor\Reflection\Types\This;
use PHPUnit\Framework\TestCase;

class PassengerRequestMapperTest extends TestCase
{
    public function testMapper()
    {
        $addPassengerRequest = $this->getMockBuilder(AddPassengerRequest::class)->disableOriginalConstructor()->getMock();
        $addPassengerRequest->expects($this->any())->method('getBirthday')->willReturn('2020-07-07 16:22:00');
        $addPassengerRequest->expects($this->any())->method('getGender')->willReturn(true);
        $account = $this->getMockBuilder(Account::class)->disableOriginalConstructor()->getMock();
        $passengerRequestMapper = new PassengerRequestMapper();
        $result = $passengerRequestMapper->mapper($addPassengerRequest, $account);

        $this->assertInstanceOf(Passenger::class, $result);
    }
}
