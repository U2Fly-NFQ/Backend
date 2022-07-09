<?php

namespace App\Tests\Request;

use App\Request\AddAccountRequest;
use PHPUnit\Framework\TestCase;

class AddAccountRequestTest extends TestCase
{
    public function testGetEmail()
    {
        $addAccountRequest = new AddAccountRequest();
        $addAccountRequest->setEmail('sang@gmail.com');
        $result = $addAccountRequest->getEmail();

        $this->assertEquals('sang@gmail.com', $result);
    }

    public function testGetImageId()
    {
        $addAccountRequest = new AddAccountRequest();
        $addAccountRequest->setImageId(1);
        $result = $addAccountRequest->getImageId();

        $this->assertEquals(1, $result);
    }

    public function testGetPassword()
    {
        $addAccountRequest = new AddAccountRequest();
        $addAccountRequest->setPassword('123');
        $result = $addAccountRequest->getPassword();

        $this->assertEquals('123', $result);
    }
}
