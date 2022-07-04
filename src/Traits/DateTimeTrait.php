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

}
