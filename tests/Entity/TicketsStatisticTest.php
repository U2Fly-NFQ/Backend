<?php

namespace App\Tests\Entity;

use App\Entity\TicketsStatistic;
use DateTime;
use PHPUnit\Framework\TestCase;

class TicketsStatisticTest extends TestCase
{
    public function testGetId()
    {
        $ticketsStatistic = new TicketsStatistic();
        $ticketsStatistic->setId(1);
        $result = $ticketsStatistic->getId();

        $this->assertEquals(1, $result);
    }

    public function testGetSuccess()
    {
        $ticketsStatistic = new TicketsStatistic();
        $ticketsStatistic->setSuccess(2);
        $result = $ticketsStatistic->getSuccess();

        $this->assertEquals(2, $result);
    }

    public function testGetCancel()
    {
        $ticketsStatistic = new TicketsStatistic();
        $ticketsStatistic->setCancel(2);
        $result = $ticketsStatistic->getCancel();

        $this->assertEquals(2, $result);
    }

    public function testGetDate()
    {
        $date = new DateTime('2022-07-09');
        $ticketsStatistic = new TicketsStatistic();
        $ticketsStatistic->setDate($date);
        $result = $ticketsStatistic->getDate();

        $this->assertEquals($date, $result);
    }

    public function testGetTime()
    {
        $ticketsStatistic = new TicketsStatistic();
        $ticketsStatistic->setTimes(2);
        $result = $ticketsStatistic->getTimes();

        $this->assertEquals(2, $result);
    }
}
