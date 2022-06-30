<?php

namespace App\Request;

class TicketRequest extends BaseRequest
{
    private int|null $account = null;
    private int|null $flight = null;

    /**
     * @return int|null
     */
    public function getAccount(): ?int
    {
        return $this->account;
    }

    /**
     * @param int|null $account
     */
    public function setAccount(?int $account): void
    {
        $this->account = $account;
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
