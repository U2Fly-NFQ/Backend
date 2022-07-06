<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class AddDiscountRequest extends BaseRequest
{
    #[Assert\Type('string')]
    private string $name;

    #[Assert\NotBlank]
    #[Assert\Type('float')]
    private float $percent;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPercent(): float
    {
        return $this->percent;
    }

    /**
     * @param float $percent
     */
    public function setPercent(float $percent): void
    {
        $this->percent = $percent;
    }
}
