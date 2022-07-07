<?php

namespace App\Request\RateRequest;

use App\Request\BaseRequest;
use Symfony\Component\Validator\Constraints as Assert;

class AddRateRequest extends BaseRequest
{
    #[Assert\NotBlank]
    #[Assert\Type('int')]
    private int $accountId;

    #[Assert\NotBlank]
    #[Assert\Type('int')]
    private int $ticketFlightId;

    #[Assert\NotBlank]
    #[Assert\Type('int')]
    private int $airlineId;

    #[Assert\NotBlank]
    #[Assert\Type('int')]
    #[Assert\Choice([1,2,3,4,5])]
    private int $rate;

    #[Assert\Type('string')]
    private string $comment;

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
    public function getTicketFlightId(): int
    {
        return $this->ticketFlightId;
    }

    /**
     * @param int $ticketFlightId
     */
    public function setTicketFlightId(int $ticketFlightId): void
    {
        $this->ticketFlightId = $ticketFlightId;
    }

    /**
     * @return int
     */
    public function getAirlineId(): int
    {
        return $this->airlineId;
    }

    /**
     * @param int $airlineId
     */
    public function setAirlineId(int $airlineId): void
    {
        $this->airlineId = $airlineId;
    }

    /**
     * @return int
     */
    public function getRate(): int
    {
        return $this->rate;
    }

    /**
     * @param int $rate
     */
    public function setRate(int $rate): void
    {
        $this->rate = $rate;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }
}
