<?php

namespace App\Request\TicketRequest;

use Symfony\Component\Validator\Constraints as Assert;
use App\Request\BaseRequest;

class ListTicketRequest extends BaseRequest
{
    #[Assert\NotBlank]
    #[Assert\Type('int')]
    private int $passenger;

    #[Assert\Type('boolean')]
    private bool $effectiveness;

    /**
     * @return int
     */
    public function getPassenger(): int
    {
        return $this->passenger;
    }

    /**
     * @param int $passenger
     */
    public function setPassenger(int $passenger): void
    {
        $this->passenger = $passenger;
    }

    /**
     * @return bool
     */
    public function isEffectiveness(): bool
    {
        return $this->effectiveness;
    }

    /**
     * @param bool $effectiveness
     */
    public function setEffectiveness(bool $effectiveness): void
    {
        $this->effectiveness = $effectiveness;
    }
}
