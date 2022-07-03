<?php

namespace App\Request;

class PaymentRequest extends BaseRequest
{
    private int $accountId;
    private int $discountId;
    private int $flightId;
    private int $seatTypeId;
    private float $totalPrice;
    private string $ticketOwner;

    /**
     * @return int
     */
    public function getAccountId(): int
    {
        return $this->accountId;
    }

    /**
     * @param int $accountId
     */
    public function setAccountId(int $accountId): void
    {
        $this->accountId = $accountId;
    }

    /**
     * @return int
     */
    public function getDiscountId(): int
    {
        return $this->discountId;
    }

    /**
     * @param int $discountId
     */
    public function setDiscountId(int $discountId): void
    {
        $this->discountId = $discountId;
    }

    /**
     * @return int
     */
    public function getFlightId(): int
    {
        return $this->flightId;
    }

    /**
     * @param int $flightId
     */
    public function setFlightId(int $flightId): void
    {
        $this->flightId = $flightId;
    }

    /**
     * @return int
     */
    public function getSeatTypeId(): int
    {
        return $this->seatTypeId;
    }

    /**
     * @param int $seatTypeId
     */
    public function setSeatTypeId(int $seatTypeId): void
    {
        $this->seatTypeId = $seatTypeId;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @param float $totalPrice
     */
    public function setTotalPrice(float $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * @return string
     */
    public function getTicketOwner(): string
    {
        return $this->ticketOwner;
    }

    /**
     * @param string $ticketOwner
     */
    public function setTicketOwner(string $ticketOwner): void
    {
        $this->ticketOwner = $ticketOwner;
    }

}
