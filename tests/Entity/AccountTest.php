<?php

namespace App\Tests\Entity;

use App\Entity\Account;
use App\Entity\Image;
use App\Entity\Passenger;
use App\Entity\Ticket;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class AccountTest extends TestCase
{
    public function testGetId()
    {
        $account =new Account();
        $account->setId(1);
        $result = $account->getId();

        $this->assertEquals(1, $result);
    }

    public function testGetTickets()
    {
        $account =new Account();
        $ticket = $this->getMockBuilder(ArrayCollection::class)->disableOriginalConstructor()->getMock();
        $account->setTickets($ticket);
        $result = $account->getTickets();

        $this->assertEquals($ticket, $result);
    }

    public function testGetEmail()
    {
        $account =new Account();
        $account->setEmail('sang.nguyen@gmail.com');
        $result = $account->getEmail();

        $this->assertEquals('sang.nguyen@gmail.com', $result);
    }

    public function testGetRoles()
    {
        $account =new Account();
        $account->setRoles(['1'=>'ROLE_ADMIN']);
        $result = $account->getRoles();

        $this->assertEquals(['1'=>'ROLE_ADMIN','2'=>'ROLE_USER'], $result);
    }

    public function testGetPassword()
    {
        $account =new Account();
        $account->setPassword('123');
        $result = $account->getPassword();

        $this->assertEquals('123', $result);
    }

    public function testGetDeletedAt()
    {
        $account =new Account();
        $account->setDeletedAt('2022-07-07 09:55:44');
        $result = $account->getDeletedAt();

        $this->assertEquals('2022-07-07 09:55:44', $result);
    }

    public function testGetImage()
    {
        $account =new Account();
        $image = $this->getMockBuilder(Image::class)->disableOriginalConstructor()->getMock();
        $account->setImage($image);
        $result = $account->getImage();

        $this->assertEquals($image, $result);
    }

    public function testGetCreatedAt()
    {
        $account =new Account();
        $createdAt = new DateTime('2022-07-07 09:55:44');
        $account->setCreatedAt($createdAt);
        $result = $account->getCreatedAt();

        $this->assertEquals($createdAt, $result);
    }

    public function testGetUserIdentifier()
    {
        $account =new Account();
        $account->setEmail('sang.nguyen@gmail.com');
        $result = $account->getUserIdentifier();

        $this->assertEquals('sang.nguyen@gmail.com', $result);
    }

    public function testGetUpdateAt()
    {
        $account =new Account();
        $account->setUpdatedAt('2022-07-07 09:55:44');
        $result = $account->getUpdatedAt();

        $this->assertEquals('2022-07-07 09:55:44', $result);
    }

    public function testGetPassenger()
    {
        $account =new Account();
        $passenger = $this->getMockBuilder(Passenger::class)->disableOriginalConstructor()->getMock();
        $account->setPassenger($passenger);
        $result = $account->getPassenger();

        $this->assertEquals($passenger, $result);
    }
}
