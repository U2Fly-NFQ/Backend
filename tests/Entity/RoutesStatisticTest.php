<?php

namespace App\Tests\Entity;

use App\Entity\RoutesStatistic;
use PHPUnit\Framework\TestCase;

class RoutesStatisticTest extends TestCase
{
    public function testGetId()
    {
        $routsStatistic = new RoutesStatistic();
        $routsStatistic->setId(1);
        $result = $routsStatistic->getId();

        $this->assertEquals(1, $result);
    }

    public function testGetArrival()
    {
        $routsStatistic = new RoutesStatistic();
        $routsStatistic->setArrival('VCA');
        $result = $routsStatistic->getArrival();

        $this->assertEquals('VCA', $result);
    }

    public function testGetDeparture()
    {
        $routsStatistic = new RoutesStatistic();
        $routsStatistic->setDeparture('HN');
        $result = $routsStatistic->getDeparture();

        $this->assertEquals('HN', $result);
    }

    public function testGetTime()
    {
        $routsStatistic = new RoutesStatistic();
        $routsStatistic->setTimes(2);
        $result = $routsStatistic->getTimes();

        $this->assertEquals(2, $result);
    }
}
