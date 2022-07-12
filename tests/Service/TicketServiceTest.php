<?php

namespace App\Tests\Service;

use App\Constant\TicketStatusConstant;
use App\Entity\Flight;
use App\Entity\SeatType;
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
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
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
        $date = new DateTime('2023-1-1');
        $flight = $this->createFlight($date);
        $ticket = $this->createTicket($flight, TicketStatusConstant::SUCCESS);
        $ticketService = $this->createTicketService();
        $result = $ticketService->cancel($ticket);

        $this->assertTrue($result);
    }

    public function testCancelNotRefundException()
    {
        $date = new DateTime('2023-1-1');
        $flight = $this->createFlight($date);
        $ticket = $this->createTicket($flight, TicketStatusConstant::CANCEL);
        $ticketService = $this->createTicketService();
        $this->expectException(Exception::class);
        $result = $ticketService->cancel($ticket);
    }

    public function testCancelOutDatedException()
    {

        $date = new DateTime('2020-1-1');
        $flight = $this->createFlight($date);
        $ticket = $this->createTicket($flight, TicketStatusConstant::SUCCESS);
        $ticketService = $this->createTicketService();
        $this->expectException(Exception::class);
        $result = $ticketService->cancel($ticket);
    }

    public function createTicket($flight, $ticketStatus)
    {
        $ticketFlight = $this->getMockBuilder(TicketFlight::class)->disableOriginalConstructor()->getMock();
        $ticketFlight->expects($this->any())->method('getFlight')->willReturn($flight);

        $seatType = $this->getMockBuilder(SeatType::class)->disableOriginalConstructor()->getMock();
        $ticketFlights = new ArrayCollection([$ticketFlight]);
        $ticket = $this->getMockBuilder(Ticket::class)->disableOriginalConstructor()->getMock();
        $ticket->expects($this->any())->method('getTicketFlights')->willReturn($ticketFlights);
        $ticket->expects($this->any())->method('getStatus')->willReturn($ticketStatus);
        $ticket->expects($this->any())->method('getSeatType')->willReturn($seatType);

        return $ticket;
    }

    public function createFlight($date)
    {
        $flight = $this->getMockBuilder(Flight::class)->disableOriginalConstructor()->getMock();
        $flight->expects($this->any())->method('getIsRefund')->willReturn(true);
        $flight->expects($this->any())->method('getStartDate')->willReturn($date);
        $flight->expects($this->any())->method('getStartTime')->willReturn($date);

        return $flight;
    }

    public function createTicketService()
    {
        $ticket = $this->getMockBuilder(Ticket::class)->disableOriginalConstructor()->getMock();
        $ticketRepository = $this->getMockBuilder(TicketRepository::class)->disableOriginalConstructor()->getMock();
        $ticketRepository->expects($this->any())->method('getAll')->willReturn([$ticket]);
        $addTicketRequest = $this->getMockBuilder(AddTicketRequest::class)->disableOriginalConstructor()->getMock();
        $addTicketRequestToTicket = $this->getMockBuilder(AddTicketRequestToTicket::class)->disableOriginalConstructor()->getMock();
        $ticketTransformer = $this->getMockBuilder(TicketTransformer::class)->disableOriginalConstructor()->getMock();
        $ticketTransformer->expects($this->any())->method('toArrayList')->willReturn(['id'=>1]);
        $flightSeatTypeRepository = $this->getMockBuilder(FlightSeatTypeRepository::class)->disableOriginalConstructor()->getMock();
        $ticketArrayToTicket = $this->getMockBuilder(TicketArrayToTicket::class)->disableOriginalConstructor()->getMock();
        $airplaneSeatTypeService = $this->getMockBuilder(AirplaneSeatTypeService::class)->disableOriginalConstructor()->getMock();

        return new TicketService($ticketRepository,$addTicketRequest, $addTicketRequestToTicket, $ticketTransformer, $flightSeatTypeRepository, $ticketArrayToTicket, $airplaneSeatTypeService);
    }
}

