<?php

namespace App\Request;

class ListFlightRequest extends BaseRequest
{
    private string|null $arrival = null;
    private string|null $departure = null;
    private string|null $startTime = null;
    private string|null $airplaneId = null;
    private string|null $airline = null;
    private string $seatType = 'Economy';
    private string|null $order = null;
    private float|null $minPrice = null;
    private float|null $maxPrice = null;
    private int $seatNumber = 1;
    private int $page = 1;
    private int $offset = 10;

    /**
     * @return string|null
     */
    public function getArrival(): ?string
    {
        return $this->arrival;
    }

    /**
     * @param string|null $arrival
     */
    public function setArrival(?string $arrival): void
    {
        $this->arrival = $arrival;
    }

    /**
     * @return string|null
     */
    public function getDeparture(): ?string
    {
        return $this->departure;
    }

    /**
     * @param string|null $departure
     */
    public function setDeparture(?string $departure): void
    {
        $this->departure = $departure;
    }

    /**
     * @return string|null
     */
    public function getStartTime(): ?string
    {
        return $this->startTime;
    }

    /**
     * @param string|null $startTime
     */
    public function setStartTime(?string $startTime): void
    {
        $this->startTime = $startTime;
    }

    /**
     * @return string|null
     */
    public function getAirplaneId(): ?string
    {
        return $this->airplaneId;
    }

    /**
     * @param string|null $airplaneId
     */
    public function setAirplaneId(?string $airplaneId): void
    {
        $this->airplaneId = $airplaneId;
    }

    /**
     * @return string|null
     */
    public function getAirline(): ?string
    {
        return $this->airline;
    }

    /**
     * @param string|null $airline
     */
    public function setAirline(?string $airline): void
    {
        $this->airline = $airline;
    }

    /**
     * @return string
     */
    public function getSeatType(): string
    {
        return $this->seatType;
    }

    /**
     * @param string $seatType
     */
    public function setSeatType(string $seatType): void
    {
        $this->seatType = $seatType;
    }

    /**
     * @return string|null
     */
    public function getOrder(): ?string
    {
        return $this->order;
    }

    /**
     * @param string|null $order
     */
    public function setOrder(?string $order): void
    {
        $this->order = $order;
    }


    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     */
    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    /**
     * @return float|null
     */
    public function getMinPrice(): ?float
    {
        return $this->minPrice;
    }

    /**
     * @param float|null $minPrice
     */
    public function setMinPrice(?float $minPrice): void
    {
        $this->minPrice = $minPrice;
    }

    /**
     * @return float|null
     */
    public function getMaxPrice(): ?float
    {
        return $this->maxPrice;
    }

    /**
     * @param float|null $maxPrice
     */
    public function setMaxPrice(?float $maxPrice): void
    {
        $this->maxPrice = $maxPrice;
    }

    /**
     * @return int
     */
    public function getSeatNumber(): int
    {
        return $this->seatNumber;
    }

    /**
     * @param int $seatNumber
     */
    public function setSeatNumber(int $seatNumber): void
    {
        $this->seatNumber = $seatNumber;
    }


}

