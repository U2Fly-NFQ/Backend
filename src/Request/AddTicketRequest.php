<?php

namespace App\Request;

class AddTicketRequest extends BaseRequest
{
    private int|null $accountId = null;
    private int|null $discountId = null;
    private int|null $flightId = null;
    private int|null $seatTypeId = null;
    private float|null $totalPrice = null;

    /**
     * @return int|null
     */
    public function getAccountId(): ?int
    {
        return $this->accountId;
    }

    /**
     * @param int|null $accountId
     */
    public function setAccountId(?int $accountId): void
    {
        $this->accountId = $accountId;
    }

    /**
     * @return int|null
     */
    public function getDiscountId(): ?int
    {
        return $this->discountId;
    }

    /**
     * @param int|null $discountId
     */
    public function setDiscountId(?int $discountId): void
    {
        $this->discountId = $discountId;
    }

    /**
     * @return int|null
     */
    public function getFlightId(): ?int
    {
        return $this->flightId;
    }

    /**
     * @param int|null $flightId
     */
    public function setFlightId(?int $flightId): void
    {
        $this->flightId = $flightId;
    }

    /**
     * @return int|null
     */
    public function getSeatTypeId(): ?int
    {
        return $this->seatTypeId;
    }

    /**
     * @param int|null $seatTypeId
     */
    public function setSeatTypeId(?int $seatTypeId): void
    {
        $this->seatTypeId = $seatTypeId;
    }

    /**
     * @return string|null
     */
    public function getTotalPrice(): ?string
    {
        return $this->totalPrice;
    }

    /**
     * @param string|null $totalPrice
     */
    public function setTotalPrice(?string $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }

}
