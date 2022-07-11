<?php

namespace App\Tests\Service;

use App\Entity\Airline;
use App\Entity\Rating;
use App\Entity\TicketFlight;
use App\Mapper\AddRateRequestMapper;
use App\Repository\AirlineRepository;
use App\Repository\RatingRepository;
use App\Repository\TicketFlightRepository;
use App\Request\RateRequest\AddRateRequest;
use App\Service\RateService;
use PHPUnit\Framework\TestCase;

class RateServiceTest extends TestCase
{
    public function testAdd()
    {
        $addRateRequest = $this->getMockBuilder(AddRateRequest::class)->disableOriginalConstructor()->getMock();
        $rateService = $this->createRateService();
        $result = $rateService->add($addRateRequest);

        $this->assertTrue($result);
    }

    public function createRateService()
    {
        $airline = $this->getMockBuilder(Airline::class)->disableOriginalConstructor()->getMock();
        $rating = $this->getMockBuilder(Rating::class)->disableOriginalConstructor()->getMock();
        $rating->expects($this->any())->method('getAirline')->willReturn($airline);
        $ticketFlight = $this->getMockBuilder(TicketFlight::class)->disableOriginalConstructor()->getMock();
        $ticketFlight->expects($this->any())->method('isIsRating')->willReturn(false);
        $addRateRequestMapper = $this->getMockBuilder(AddRateRequestMapper::class)->disableOriginalConstructor()->getMock();
        $addRateRequestMapper->expects($this->any())->method('mapper')->willReturn($rating);
        $ratingRepository = $this->getMockBuilder(RatingRepository::class)->disableOriginalConstructor()->getMock();
        $ticketFlightRepository = $this->getMockBuilder(TicketFlightRepository::class)->disableOriginalConstructor()->getMock();
        $ticketFlightRepository->expects($this->any())->method('find')->willReturn($ticketFlight);
        $airlineRopository = $this->getMockBuilder(AirlineRepository::class)->disableOriginalConstructor()->getMock();

        return new RateService($addRateRequestMapper,$ratingRepository, $ticketFlightRepository, $airlineRopository);
    }
}
