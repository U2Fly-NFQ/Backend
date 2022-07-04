<?php

namespace App\Constant;

class MomentConstant
{
    public const MOMENT = [
        'earlymorning' => ['startTime' => '00-00', 'endTime' => '06-00'],
        'morning' => ['startTime' => '06-01', 'endTime' => '12-00'],
        'afternoon' => ['startTime' => '12-01', 'endTime' => '18-00'],
        'night' => ['startTime' => '18-01', 'endTime' => '23-59'],
    ];
}
