<?php

namespace App\Request;

class AddTicketRequest extends BaseRequest
{
    private int|null $passengerId = null;
    private int|null $discountId = 1;
    private int|null $flightId = null;
    private int|null $seatTypeId = null;
    private float|null $totalPrice = null;
    private string|null $ticketOwner = null;

    /**
     * @return int|null
     */
    public function getPassengerId(): ?int
    {
        return $this->passengerId;
    }

    /**
     * @param int|null $passengerId
     */
    public function setPassengerId(?int $passengerId): void
    {
        $this->passengerId = $passengerId;
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

    /**
     * @return string|null
     */
    public function getTicketOwner(): ?string
    {
        return $this->ticketOwner;
    }

    /**
     * @param string|null $ticketOwner
     */
    public function setTicketOwner(?string $ticketOwner): void
    {
        $this->ticketOwner = $ticketOwner;
    }
}
