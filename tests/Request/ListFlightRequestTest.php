<?php

namespace App\Tests\Request;

use App\Request\ListFlightRequest;
use PHPUnit\Framework\TestCase;

class ListFlightRequestTest extends TestCase
{
    public function testGetArrival()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setArrival('HAN');
        $result = $listFlightRequest->getArrival();

        $this->assertEquals('HAN', $result);
    }

    public function testGetDeparture()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setDeparture('HAN');
        $result = $listFlightRequest->getDeparture();

        $this->assertEquals('HAN', $result);
    }

    public function testGetStartTime()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setStartTime('07:00:00');
        $result = $listFlightRequest->getStartTime();

        $this->assertEquals('07:00:00', $result);
    }

    public function testGetStartDate()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setStartDate('2022-07-09');
        $result = $listFlightRequest->getStartDate();

        $this->assertEquals('2022-07-09', $result);
    }

    public function testGetAirplaneId()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setAirplaneId(1);
        $result = $listFlightRequest->getAirplaneId();

        $this->assertEquals(1, $result);
    }

    public function testGetAirline()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setAirline('HVN');
        $result = $listFlightRequest->getAirline();

        $this->assertEquals('HVN', $result);
    }

    public function testGetSeatType()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setSeatType('Economy');
        $result = $listFlightRequest->getSeatType();

        $this->assertEquals('Economy', $result);
    }

    public function testGetOrder()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setOrder('duration');
        $result = $listFlightRequest->getOrder();

        $this->assertEquals('duration', $result);
    }

    public function testGetMinPrice()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setMinPrice(300);
        $result = $listFlightRequest->getMinPrice();

        $this->assertEquals(300, $result);
    }

    public function testGetMaxPrice()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setMaxPrice(3000);
        $result = $listFlightRequest->getMaxPrice();

        $this->assertEquals(3000, $result);
    }

    public function testGetSeatNumber()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setSeatNumber(50);
        $result = $listFlightRequest->getSeatNumber();

        $this->assertEquals(50, $result);
    }

    public function testGetPage()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setPage(2);
        $result = $listFlightRequest->getPage();

        $this->assertEquals(2, $result);
    }

    public function testGetOffset()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setOffset(5);
        $result = $listFlightRequest->getOffset();

        $this->assertEquals(5, $result);
    }

    public function testGetArrivalRoundTrip()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setArrivalRoundTrip('HAN');
        $result = $listFlightRequest->getArrivalRoundTrip();

        $this->assertEquals('HAN', $result);
    }

    public function testGetDepartureRoundTrip()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setDepartureRoundTrip('HAN');
        $result = $listFlightRequest->getDepartureRoundTrip();

        $this->assertEquals('HAN', $result);
    }

    public function testGetStartTimeRoundTrip()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setStartTimeRoundTrip('07:00:00');
        $result = $listFlightRequest->getStartTimeRoundTrip();

        $this->assertEquals('07:00:00', $result);
    }

    public function testGetStartDateRoundTrip()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setStartDateRoundTrip('2022-07-09');
        $result = $listFlightRequest->getStartDateRoundTrip();

        $this->assertEquals('2022-07-09', $result);
    }

    public function testGetAirplaneIdRoundTrip()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setAirplaneIdRoundTrip(2);
        $result = $listFlightRequest->getAirplaneIdRoundTrip();

        $this->assertEquals(2, $result);
    }

    public function testGetAirlineRoundTrip()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setAirlineRoundTrip('Vietnam Airlines');
        $result = $listFlightRequest->getAirlineRoundTrip();

        $this->assertEquals('Vietnam Airlines', $result);
    }

    public function testGetSeatTypeRoundTrip()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setSeatTypeRoundTrip('Business');
        $result = $listFlightRequest->getSeatTypeRoundTrip();

        $this->assertEquals('Business', $result);
    }

    public function testGetOrderRoundTrip()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setOrderRoundTrip('duration');
        $result = $listFlightRequest->getOrderRoundTrip();

        $this->assertEquals('duration', $result);
    }

    public function testGetMinPriceRoundTrip()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setMinPriceRoundTrip(330);
        $result = $listFlightRequest->getMinPriceRoundTrip();

        $this->assertEquals(330, $result);
    }

    public function testGetMaxPriceRoundTrip()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setMaxPriceRoundTrip(5500);
        $result = $listFlightRequest->getMaxPriceRoundTrip();

        $this->assertEquals(5500, $result);
    }

    public function testGetSeatNumberRoundTrip()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setSeatNumberRoundTrip(55);
        $result = $listFlightRequest->getSeatNumberRoundTrip();

        $this->assertEquals(55, $result);
    }

    public function testGetPageRoundTrip()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setPageRoundTrip(2);
        $result = $listFlightRequest->getPageRoundTrip();

        $this->assertEquals(2, $result);
    }

    public function testGetOffsetRoundTrip()
    {
        $listFlightRequest = new ListFlightRequest();
        $listFlightRequest->setOffsetRoundTrip(5);
        $result = $listFlightRequest->getOffsetRoundTrip();

        $this->assertEquals(5, $result);
    }

    public function testSplitOneWayAndRoundTrip()
    {
        $listFlightRequested = $this->getMockBuilder(ListFlightRequest::class)->disableOriginalConstructor()->getMock();
        $listFlightRequest = new ListFlightRequest();
        $result = $listFlightRequest->splitOneWayAndRoundTrip([$listFlightRequested]);

        $this->assertIsArray($result);
    }
}
