<?php

namespace App\Tests\Entity;

use App\Entity\Account;
use App\Entity\Passenger;
use PHPUnit\Framework\TestCase;

class PassengerTest extends TestCase
{
    public function testGetId()
    {
        $passenger = new Passenger();
        $passenger->setId(1);
        $result = $passenger->getId();

        $this->assertEquals(1,$result);
    }

    public function testGetName()
    {
        $passenger = new Passenger();
        $passenger->setName('Hoai');
        $result = $passenger->getName();

        $this->assertEquals('Hoai',$result);
    }

    public function testGetGender()
    {
        $passenger = new Passenger();
        $passenger->setGender(1);
        $result = $passenger->getGender();

        $this->assertEquals('Male',$result);
    }

    public function testGetBirthDay()
    {
        $passenger = new Passenger();
        $passenger->setBirthday('2020-07-07 16:22:00');
        $result = $passenger->getBirthday();

        $this->assertEquals('2020-07-07 16:22:00',$result);
    }

    public function testGetIdentification()
    {
        $passenger = new Passenger();
        $passenger->setIdentification('1893129412');
        $result = $passenger->getIdentification();

        $this->assertEquals('1893129412',$result);
    }

    public function testGetCreatedAt()
    {
        $passenger = new Passenger();
        $passenger->setCreatedAt('2020-07-07 16:22:00');
        $result = $passenger->getCreatedAt();

        $this->assertEquals('2020-07-07 16:22:00',$result);
    }

    public function testGetUpdatedAt()
    {
        $passenger = new Passenger();
        $passenger->setUpdatedAt('2020-07-07 16:22:00');
        $result = $passenger->getUpdatedAt();

        $this->assertEquals('2020-07-07 16:22:00',$result);
    }

    public function testGetDeletedAt()
    {
        $passenger = new Passenger();
        $passenger->setDeletedAt('2020-07-07 16:22:00');
        $result = $passenger->getDeletedAt();

        $this->assertEquals('2020-07-07 16:22:00',$result);
    }

    public function testAccount()
    {
        $account = $this->getMockBuilder(Account::class)->disableOriginalConstructor()->getMock();
        $passenger = new Passenger();
        $passenger->setAccount($account);
        $result = $passenger->getAccount();

        $this->assertEquals($account,$result);
    }

    public function testGetAddress()
    {
        $passenger = new Passenger();
        $passenger->setAddress('16 Mau Than');
        $result = $passenger->getAddress();

        $this->assertEquals('16 Mau Than',$result);
    }
}
