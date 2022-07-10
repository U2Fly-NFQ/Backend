<?php

namespace App\Tests\Mapper;

use App\Entity\Ticket;
use App\Mapper\TicketArrayToTicket;
use App\Repository\DiscountRepository;
use App\Repository\PassengerRepository;
use App\Repository\SeatTypeRepository;
use PHPUnit\Framework\TestCase;

class TicketArrayToTicketTest extends TestCase
{
    public function testMapper()
    {
        $paymentData = [
            "passengerId" => 1,
            "discountId" => 1,
            "flightId" => 1,
            "seatTypeId" => 1,
            "totalPrice" => 100,
            "ticketOwner" => 'Nguyen Thanh Sang'
        ];
        $paymentId = "paymentIdString";

        $passengerRepository = $this->getMockBuilder(PassengerRepository::class)->disableOriginalConstructor()->getMock();
        $discountRepository = $this->getMockBuilder(DiscountRepository::class)->disableOriginalConstructor()->getMock();
        $seatTypeRepository = $this->getMockBuilder(SeatTypeRepository::class)->disableOriginalConstructor()->getMock();
        $ticketArrayToTicket = new TicketArrayToTicket($passengerRepository, $discountRepository, $seatTypeRepository);
        $result = $ticketArrayToTicket->mapper($paymentData, $paymentId);

        $this->assertInstanceOf(Ticket::class, $result);
    }
}
