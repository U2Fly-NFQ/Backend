<?php

namespace App\Tests\Request;

use App\Request\RefundRequest;
use PHPUnit\Framework\TestCase;

class RefundRequestTest extends TestCase
{
    public function testGetPaymentId()
    {
        $refundRequest = new RefundRequest();
        $refundRequest->setPaymentId('IADAS432SDA');
        $result = $refundRequest->getPaymentId();

        $this->assertEquals('IADAS432SDA', $result);
    }
}
