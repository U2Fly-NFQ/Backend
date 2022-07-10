<?php

namespace App\Tests\Entity;

use App\Entity\Rule;
use DateTime;
use PHPUnit\Framework\TestCase;

class RuleTest extends TestCase
{
    public function testGetId()
    {
        $rule = new Rule();
        $rule->setId(1);
        $result = $rule->getId();

        $this->assertEquals(1, $result);
    }

    public function testGetName()
    {
        $rule = new Rule();
        $rule->setName('pet');
        $result = $rule->getName();

        $this->assertEquals('pet', $result);
    }

    public function testGetCreatedAt()
    {
        $date = new DateTime('2020-07-07 16:22:00');
        $rule = new Rule();
        $rule->setCreatedAt($date);
        $result = $rule->getCreatedAt();

        $this->assertEquals($date, $result);
    }

    public function testGetUpdatedAt()
    {
        $date = new DateTime('2020-07-07 16:22:00');
        $rule = new Rule();
        $rule->setUpdatedAt($date);
        $result = $rule->getUpdatedAt();

        $this->assertEquals($date, $result);
    }

    public function testGetDeletedAt()
    {
        $date = new DateTime('2020-07-07 16:22:00');
        $rule = new Rule();
        $rule->setDeletedAt($date);
        $result = $rule->getDeletedAt();

        $this->assertEquals($date, $result);
    }
}
