<?php

namespace App\Tests\Service;

use App\Entity\Account;
use App\Entity\Passenger;
use App\Mapper\PassengerRequestMapper;
use App\Repository\PassengerRepository;
use App\Request\PassengerRequest\AddPassengerRequest;
use App\Service\PassengerService;
use PHPUnit\Framework\TestCase;

class PassengerServiceTest extends TestCase
{
    /**
     * @dataProvider addDataProvider
     * @return void
     * @throws \Exception
     */
    public function testAdd($param)
    {
        $passengerService = $this->createPassengerService();
        $result = $passengerService->add($param['addPassengerRequest'], $param['account']);

        $this->assertInstanceOf(Passenger::class, $result);
    }

    public function addDataProvider()
    {
        $addPassengerRequest = new AddPassengerRequest();
        $account = new Account();
        return [
          'happy-case-1'=>[
              'param'=>[
                  'addPassengerRequest'=>$addPassengerRequest,
                  'account'=>$account
              ]
          ]
        ];
    }

    public function createPassengerService()
    {
        $passengerRepository = $this->getMockBuilder(PassengerRepository::class)->disableOriginalConstructor()->getMock();
        $passengerRequestMapper = $this->getMockBuilder(PassengerRequestMapper::class)->disableOriginalConstructor()->getMock();
        return new PassengerService($passengerRequestMapper, $passengerRepository);
    }
}
