<?php

namespace App\Tests\Transformer;

use App\Entity\Account;
use App\Transformer\AccountTransformer;
use App\Transformer\PassengerTransformer;
use PHPUnit\Framework\TestCase;

class AccountTransformerTest extends TestCase
{
    public function testToArrayList()
    {
        $account = $this->getMockBuilder(Account::class)->disableOriginalConstructor()->getMock();
        $accountTransformer = $this->createAccountTransformer();
        $result = $accountTransformer->toArrayList([$account]);

        $this->assertIsArray($result);
    }

    public function testToArray()
    {
        $account = $this->getMockBuilder(Account::class)->disableOriginalConstructor()->getMock();
        $accountTransformer = $this->createAccountTransformer();
        $result = $accountTransformer->toArray($account);

        $this->assertIsArray($result);
    }

    public function createAccountTransformer()
    {
        $passengerTransformer = $this->getMockBuilder(PassengerTransformer::class)->disableOriginalConstructor()->getMock();
        return new AccountTransformer($passengerTransformer);
    }
}
