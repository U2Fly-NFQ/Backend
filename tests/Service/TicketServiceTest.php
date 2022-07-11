<?php

namespace App\Tests\Service;

use App\Entity\Flight;
use App\Entity\Ticket;
use App\Entity\TicketFlight;
use App\Mapper\AddTicketRequestToTicket;
use App\Mapper\TicketArrayToTicket;
use App\Repository\FlightSeatTypeRepository;
use App\Repository\TicketRepository;
use App\Request\AddTicketRequest;
use App\Request\TicketRequest\ListTicketRequest;
use App\Service\AirplaneSeatTypeService;
use App\Service\TicketService;
use App\Transformer\TicketTransformer;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class TicketServiceTest extends TestCase
{
    public function testAdd()
    {
        $addticketRequest = $this->getMockBuilder(AddTicketRequest::class)->disableOriginalConstructor()->getMock();
        $ticketService = $this->createTicketService();
        $result = $ticketService->add($addticketRequest);

        $this->assertInstanceOf(Ticket::class, $result);

    }

    public function testAddByArrayData()
    {
        $ticketService = $this->createTicketService();
        $result = $ticketService->addByArrayData(['metadate'], 'ADRS31');

        $this->assertInstanceOf(Ticket::class, $result);

    }

    public function testFindAll()
    {
        $listTicketRequest = $this->getMockBuilder(ListTicketRequest::class)->disableOriginalConstructor()->getMock();
        $ticketService = $this->createTicketService();
        $result = $ticketService->findAll($listTicketRequest);

        $this->assertIsArray($result);

    }

    public function testCancel()
    {
        $flight = $this->getMockBuilder(Flight::class)->disableOriginalConstructor()->getMock();
        $ticketFlight = $this->getMockBuilder(Collection::class)->disableOriginalConstructor()->getMock();
        $ticket = $this->getMockBuilder(Ticket::class)->disableOriginalConstructor()->getMock();
        $ticket->expects($this->any())->method('getTicketFlights')->willReturn($ticketFlight);
        $ticketService = $this->createTicketService();
        $result = $ticketService->cancel($ticket);

        $this->assertTrue($result);

    }

    public function createTicketService()
    {
        $ticket = $this->getMockBuilder(Ticket::class)->disableOriginalConstructor()->getMock();
        $ticketRepository = $this->getMockBuilder(TicketRepository::class)->disableOriginalConstructor()->getMock();
        $ticketRepository->expects($this->any())->method('getAll')->willReturn([$ticket]);
        $addTicketRequest = $this->getMockBuilder(AddTicketRequest::class)->disableOriginalConstructor()->getMock();
        $addticketRequestToTicket = $this->getMockBuilder(AddTicketRequestToTicket::class)->disableOriginalConstructor()->getMock();
        $ticketTransformer = $this->getMockBuilder(TicketTransformer::class)->disableOriginalConstructor()->getMock();
        $ticketTransformer->expects($this->any())->method('toArrayList')->willReturn(['id'=>1]);
        $flightSeatTypeRepository = $this->getMockBuilder(FlightSeatTypeRepository::class)->disableOriginalConstructor()->getMock();
        $ticketArrayToTicket = $this->getMockBuilder(TicketArrayToTicket::class)->disableOriginalConstructor()->getMock();
        $airplaneSeatTypeService = $this->getMockBuilder(AirplaneSeatTypeService::class)->disableOriginalConstructor()->getMock();

        return new TicketService($ticketRepository,$addTicketRequest, $addticketRequestToTicket, $ticketTransformer, $flightSeatTypeRepository, $ticketArrayToTicket, $airplaneSeatTypeService);
    }
}
