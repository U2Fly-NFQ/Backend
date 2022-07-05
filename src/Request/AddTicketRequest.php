<?php

namespace App\Request;

class AddTicketRequest extends BaseRequest
{
    #[Assert\NotBlank\Type('int')]
    private int $passengerId;

    #[Assert\Type('int')]
    private int $discountId;

    #[Assert\NotBlank\Type('array')]
    private array $flights;

    #[Assert\NotBlank\Type('int')]
    private int $seatTypeId;

    #[Assert\NotBlank\Type('float')]
    private float $totalPrice;

    #[Assert\NotBlank\Type('string')]
    private string $ticketOwner;

    /**
     * @return int
     */
    public function getPassengerId(): int
    {
        return $this->passengerId;
    }

    /**
     * @param int $passengerId
     */
    public function setPassengerId(int $passengerId): void
    {
        $this->passengerId = $passengerId;
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
     * @return array
     */
    public function getFlights(): array
    {
        return $this->flights;
    }

    /**
     * @param array $flights
     */
    public function setFlights(array $flights): void
    {
        $this->flights = $flights;
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
