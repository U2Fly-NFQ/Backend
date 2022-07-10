<?php

namespace App\Tests\Mapper;

use App\Entity\Ticket;
use App\Mapper\AddTicketRequestToTicket;
use App\Repository\DiscountRepository;
use App\Repository\PassengerRepository;
use App\Repository\SeatTypeRepository;
use App\Request\AddTicketRequest;
use PHPUnit\Framework\TestCase;

class AddTicketRequestToTicketTest extends TestCase
{
    public function testMapper()
    {
        $passengerRepository = $this->getMockBuilder(PassengerRepository::class)->disableOriginalConstructor()->getMock();
        $discountRepository = $this->getMockBuilder(DiscountRepository::class)->disableOriginalConstructor()->getMock();
        $seatTypeRepository = $this->getMockBuilder(SeatTypeRepository::class)->disableOriginalConstructor()->getMock();

        $addTicketRequestToTicket = new AddTicketRequestToTicket($passengerRepository, $discountRepository, $seatTypeRepository);

        $addTicketRequest = $this->getMockBuilder(AddTicketRequest::class)->disableOriginalConstructor()->getMock();
        $result = $addTicketRequestToTicket->mapper($addTicketRequest);
        
        $this->assertInstanceOf(Ticket::class, $result);
    }
}
