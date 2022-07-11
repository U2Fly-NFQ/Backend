<?php

namespace App\Tests\Request;

use App\Request\StripePaymentRequest;
use PHPUnit\Framework\TestCase;

class StripePaymentRequestTest extends TestCase
{
    public function testGetPassengerId()
    {
        $stripePaymentRequest = new StripePaymentRequest();
        $stripePaymentRequest->setPassengerId(1);
        $result = $stripePaymentRequest->getPassengerId();

        $this->assertEquals(1, $result);
    }

    public function testGetDiscountId()
    {
        $stripePaymentRequest = new StripePaymentRequest();
        $stripePaymentRequest->setDiscountId(1);
        $result = $stripePaymentRequest->getDiscountId();

        $this->assertEquals(1, $result);
    }

    public function testGetFlightId()
    {
        $stripePaymentRequest = new StripePaymentRequest();
        $stripePaymentRequest->setFlightId(2);
        $result = $stripePaymentRequest->getFlightId();

        $this->assertEquals(2, $result);
    }

    public function testGetSeatTypeId()
    {
        $stripePaymentRequest = new StripePaymentRequest();
        $stripePaymentRequest->setSeatTypeId(2);
        $result = $stripePaymentRequest->getSeatTypeId();

        $this->assertEquals(2, $result);
    }

    public function testGetTotalPrice()
    {
        $stripePaymentRequest = new StripePaymentRequest();
        $stripePaymentRequest->setTotalPrice(1000);
        $result = $stripePaymentRequest->getTotalPrice();

        $this->assertEquals(1000, $result);
    }

    public function testGetTicketOwner()
    {
        $stripePaymentRequest = new StripePaymentRequest();
        $stripePaymentRequest->setTicketOwner('Sang');
        $result = $stripePaymentRequest->getTicketOwner();

        $this->assertEquals('Sang', $result);
    }
}
