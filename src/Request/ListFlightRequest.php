<?php

namespace App\Request;

class ListFlightRequest extends BaseRequest
{
    private string|null $arrival = null;
    private string|null $departure = null;
    private string|null $startTime = null;
    private string|null $airplaneId = null;
    private string|null $airline = null;
    private string|null $seatType = null;
    private string|null $order = null;
    private float|null $price = null;

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
     * @return string|null
     */
    public function getSeatType(): ?string
    {
        return $this->seatType;
    }

    /**
     * @param string|null $seatType
     */
    public function setSeatType(?string $seatType): void
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
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     */
    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }
}
