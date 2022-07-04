<?php

namespace App\Traits;

use App\Constant\DatetimeConstant;
use DateTime;
use DateTimeImmutable;

trait DateTimeTrait
{
    public function dateSubtract(DateTime $startDate, DateTime $endDate): float
    {
        $start = strtotime($startDate->format(DatetimeConstant::DATETIME_DEFAULT));
        $end = strtotime($endDate->format(DatetimeConstant::DATETIME_DEFAULT));

        return $end - $start;
    }

    public function secondToHours(float $second): float
    {
        return $second / (60 * 60);
    }

    public function dateTimeToDate($dateTime)
    {
        return $dateTime->format('d-m-Y');
    }

    public function dateTimeToTime($dateTime)
    {
        return $dateTime->format('H:i:s');
    }
}
