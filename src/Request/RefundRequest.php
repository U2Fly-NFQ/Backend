<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class RefundRequest extends BaseRequest
{
    #[Assert\Type('string')]
    private string $paymentId;

    /**
     * @return string
     */
    public function getPaymentId(): string
    {
        return $this->paymentId;
    }

    /**
     * @param string $paymentId
     */
    public function setPaymentId(string $paymentId): void
    {
        $this->paymentId = $paymentId;
    }

}
