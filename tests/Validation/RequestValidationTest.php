<?php

namespace App\Tests\Validation;

use PHPUnit\Framework\TestCase;

class RequestValidationTest extends TestCase
{
    /**
     * @dataProvider ValidateProvider
     * @return void
     */
    public function testValidate()
    {

    }

    public function ValidateProvider()
    {
        $rule = new AirlineRule();

        return [
          $param =>
        ];
    }
}
