<?php

namespace App\Traits;

use App\Constant\DatetimeConstant;
use DateTime;

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

    public function dateTimeToTime(DateTime $dateTime)
    {
        return $dateTime->format('h:i:s');
    }

    public function dateTimeToDate(DateTime $dateTime)
    {
        return $dateTime->format('d-m-Y');
    }
}
