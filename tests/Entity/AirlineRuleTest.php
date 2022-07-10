<?php

namespace App\Tests\Entity;

use App\Entity\Airline;
use App\Entity\AirlineRule;
use App\Entity\Rule;
use DateTime;
use PHPUnit\Framework\TestCase;

class AirlineRuleTest extends TestCase
{
    public function testGetRule()
    {
        $rule = $this->getMockBuilder(Rule::class)->disableOriginalConstructor()->getMock();
        $airlineRule = new AirlineRule();
        $airlineRule->setRule($rule);
        $result = $airlineRule->getRule();

        $this->assertEquals($rule, $result);
    }

    public function testGetAirline()
    {
        $airline = $this->getMockBuilder(Airline::class)->disableOriginalConstructor()->getMock();
        $airlineRule = new AirlineRule();
        $airlineRule->setAirline($airline);
        $result = $airlineRule->getAirline();

        $this->assertEquals($airline, $result);
    }

    public function testGetCreatedAt()
    {
        $date = new DateTime('2022-07-07 16:05:00');
        $airlineRule = new AirlineRule();
        $airlineRule->setCreatedAt($date);
        $result = $airlineRule->getCreatedAt();

        $this->assertEquals($date, $result);
    }

    public function testGetUpdatedAt()
    {
        $date = new DateTime('2022-07-07 16:05:00');
        $airlineRule = new AirlineRule();
        $airlineRule->setUpdatedAt($date);
        $result = $airlineRule->getUpdatedAt();

        $this->assertEquals($date, $result);
    }

    public function testGetDeletedAt()
    {
        $date = new DateTime('2022-07-07 16:05:00');
        $airlineRule = new AirlineRule();
        $airlineRule->setDeletedAt($date);
        $result = $airlineRule->getDeletedAt();

        $this->assertEquals($date, $result);
    }
}
