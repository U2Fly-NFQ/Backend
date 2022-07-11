<?php

namespace App\Tests\Mapper;

use App\Constant\ErrorsConstant;
use App\Entity\Account;
use App\Entity\Airline;
use App\Entity\Rating;
use App\Entity\TicketFlight;
use App\Mapper\AddRateRequestMapper;
use App\Repository\AccountRepository;
use App\Repository\AirlineRepository;
use App\Repository\TicketFlightRepository;
use App\Request\RateRequest\AddRateRequest;
use Exception;
use PHPUnit\Framework\TestCase;

class AddRateRequestMapperTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testMapper()
    {
        $ticketFlightRepository = $this->getMockBuilder(TicketFlightRepository::class)->disableOriginalConstructor()->getMock();
        $ticketFlight = $this->getMockBuilder(TicketFlight::class)->disableOriginalConstructor()->getMock();
        $ticketFlightRepository->expects($this->any())->method('find')->willReturn($ticketFlight);

        $airlineRepository = $this->getMockBuilder(AirlineRepository::class)->disableOriginalConstructor()->getMock();
        $airline = $this->getMockBuilder(Airline::class)->disableOriginalConstructor()->getMock();
        $airlineRepository->expects($this->any())->method('find')->willReturn($airline);

        $accountRepository = $this->getMockBuilder(AccountRepository::class)->disableOriginalConstructor()->getMock();
        $account = $this->getMockBuilder(Account::class)->disableOriginalConstructor()->getMock();
        $accountRepository->expects($this->any())->method('find')->willReturn($account);

        $addRateRequestMapper = new AddRateRequestMapper($ticketFlightRepository, $airlineRepository, $accountRepository);

        $addRateRequest = $this->getMockBuilder(AddRateRequest::class)->disableOriginalConstructor()->getMock();
        $addRateRequest->expects($this->any())->method('getComment')->willReturn('This is good');
        $result = $addRateRequestMapper->mapper($addRateRequest);

        $this->assertInstanceOf(Rating::class, $result);
    }

    public function testAccountNotFoundException()
    {
        $ticketFlightRepository = $this->getMockBuilder(TicketFlightRepository::class)->disableOriginalConstructor()->getMock();
        $ticketFlight = $this->getMockBuilder(TicketFlight::class)->disableOriginalConstructor()->getMock();
        $ticketFlightRepository->expects($this->any())->method('find')->willReturn($ticketFlight);

        $airlineRepository = $this->getMockBuilder(AirlineRepository::class)->disableOriginalConstructor()->getMock();
        $airline = $this->getMockBuilder(Airline::class)->disableOriginalConstructor()->getMock();
        $airlineRepository->expects($this->any())->method('find')->willReturn($airline);

        $accountRepository = $this->getMockBuilder(AccountRepository::class)->disableOriginalConstructor()->getMock();

        $addRateRequestMapper = new AddRateRequestMapper($ticketFlightRepository, $airlineRepository, $accountRepository);

        $addRateRequest = $this->getMockBuilder(AddRateRequest::class)->disableOriginalConstructor()->getMock();
        $this->expectExceptionMessage(ErrorsConstant::TICKET_OR_ACCOUNT_NOT_FOUND);
        $addRateRequestMapper->mapper($addRateRequest);
    }

    public function testFlightNotFoundException()
    {
        $ticketFlightRepository = $this->getMockBuilder(TicketFlightRepository::class)->disableOriginalConstructor()->getMock();

        $airlineRepository = $this->getMockBuilder(AirlineRepository::class)->disableOriginalConstructor()->getMock();
        $accountRepository = $this->getMockBuilder(AccountRepository::class)->disableOriginalConstructor()->getMock();

        $addRateRequestMapper = new AddRateRequestMapper($ticketFlightRepository, $airlineRepository, $accountRepository);

        $addRateRequest = $this->getMockBuilder(AddRateRequest::class)->disableOriginalConstructor()->getMock();
        $this->expectExceptionMessage(ErrorsConstant::TICKET_FLIGHT_NOT_FOUND);
        $addRateRequestMapper->mapper($addRateRequest);
    }
}
