<?php

namespace App\Tests\Traits;

use App\Traits\DateTimeTrait;
use DateTime;
use PHPUnit\Framework\TestCase;

class DateTimeTraitTest extends TestCase
{
    use DateTimeTrait;

    public function testDateSubtract()
    {
        $startDate = new DateTime('2022-07-10 00:00:00');
        $endDate = new DateTime('2022-07-11 00:00:00');
        $result = $this->dateSubtract($startDate, $endDate);
        $expected = 86400.0;
        $this->assertEquals($result, $expected);
    }

    public function testSecondToHours()
    {
        $result = $this->secondToHours(3600);
        $expected = 1.0;
        $this->assertEquals($result, $expected);
    }

    public function testDateTimeToDate()
    {
        $date = new DateTime('2022-07-10 00:00:00');
        $result = $this->dateTimeToDate($date);
        $expected = '2022-07-10';
        $this->assertEquals($result, $expected);
    }

    public function testDateTimeToTime()
    {
        $date = new DateTime('2022-07-10 07:30:00');
        $result = $this->dateTimeToTime($date);
        $expected = '07:30:00';
        $this->assertEquals($result, $expected);
    }
}