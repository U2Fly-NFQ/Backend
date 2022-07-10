<?php

namespace App\Tests\Entity;

use App\Entity\Account;
use App\Entity\Airline;
use App\Entity\Rating;
use App\Entity\TicketFlight;
use DateTime;
use PHPUnit\Framework\TestCase;

class RatingTest extends TestCase
{
    public function testGetId()
    {
        $rating = new Rating();
        $rating->setId(1);
        $result = $rating->getId();

        $this->assertEquals(1, $result);
    }

    public function testGetAccount()
    {
        $account = $this->getMockBuilder(Account::class)->disableOriginalConstructor()->getMock();
        $rating = new Rating();
        $rating->setAccount($account);
        $result = $rating->getAccount();

        $this->assertEquals($account, $result);
    }

    public function testGetAirline()
    {
        $airline = $this->getMockBuilder(Airline::class)->disableOriginalConstructor()->getMock();
        $rating = new Rating();
        $rating->setAirline($airline);
        $result = $rating->getAirline();

        $this->assertEquals($airline, $result);
    }

    public function testGetRate()
    {
        $rating = new Rating();
        $rating->setRate(1);
        $result = $rating->getRate();

        $this->assertEquals(1, $result);
    }

    public function testGetComment()
    {
        $rating = new Rating();
        $rating->setComment('It was good');
        $result = $rating->getComment();

        $this->assertEquals('It was good', $result);
    }

    public function testGetCreatedAt()
    {
        $date = new DateTime('2020-07-07 16:22:00');
        $rating = new Rating();
        $rating->setCreateAt($date);
        $result = $rating->getCreateAt();

        $this->assertEquals($date, $result);
    }

    public function testGetTicketFlight()
    {
        $ticketFlight = $this->getMockBuilder(TicketFlight::class)->disableOriginalConstructor()->getMock();
        $rating = new Rating();
        $rating->setTicketFlight($ticketFlight);
        $result = $rating->getTicketFlight();

        $this->assertEquals($ticketFlight, $result);
    }
}
