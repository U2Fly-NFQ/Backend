<?php

namespace App\Tests\Entity;

use App\Entity\Discount;
use App\Entity\Ticket;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class DiscountTest extends TestCase
{
    public function testGetId()
    {
        $discount = new Discount();
        $discount->setId(1);
        $result = $discount->getId();

        $this->assertEquals(1, $result);
    }

    public function testGetName()
    {
        $discount = new Discount();
        $discount->setName('new years');
        $result = $discount->getName();

        $this->assertEquals('new years', $result);
    }

    public function testGetPercent()
    {
        $discount = new Discount();
        $discount->setPercent(15);
        $result = $discount->getPercent();

        $this->assertEquals(15, $result);
    }

    public function testGetTicket()
    {
        $ticket = $this->getMockBuilder(ArrayCollection::class)->disableOriginalConstructor()->getMock();
        $discount = new Discount();
        $discount->setTickets($ticket);
        $result = $discount->getTickets();

        $this->assertEquals($ticket, $result);
    }

    public function testCreatedAd()
    {
        $date = new DateTime('2022-07-09 11:10:40');
        $discount = new Discount();
        $discount->setCreatedAt($date);
        $result = $discount->getCreatedAt();

        $this->assertEquals($date, $result);
    }

    public function testDeletedAd()
    {
        $date = new DateTime('2022-07-09 11:10:40');
        $discount = new Discount();
        $discount->setDeletedAt($date);
        $result = $discount->getDeletedAt();

        $this->assertEquals($date, $result);
    }

    public function testUpdatedAd()
    {
        $date = new DateTime('2022-07-09 11:10:40');
        $discount = new Discount();
        $discount->setUpdatedAt($date);
        $result = $discount->getUpdatedAt();

        $this->assertEquals($date, $result);
    }
}
