<?php

namespace App\Transformer;

use App\Constant\DatetimeConstant;
use App\Entity\Airline;
use PHP_CodeSniffer\Tests\Core\Tokenizer\DoubleArrowTest;

class AirlineTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'name', 'icao'];

}
