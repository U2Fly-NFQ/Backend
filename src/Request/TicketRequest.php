<?php

namespace App\Request;

class TicketRequest extends BaseRequest
{
    private int|null $passenger = null;
    private int|null $flight = null;

    /**
     * @return int|null
     */
    public function getPassenger(): ?int
    {
        return $this->passenger;
    }

    /**
     * @param int|null $passenger
     */
    public function setPassenger(?int $passenger): void
    {
        $this->passenger = $passenger;
    }

    /**
     * @return int|null
     */
    public function getFlight(): ?int
    {
        return $this->flight;
    }

    /**
     * @param int|null $flight
     */
    public function setFlight(?int $flight): void
    {
        $this->flight = $flight;
    }
}
