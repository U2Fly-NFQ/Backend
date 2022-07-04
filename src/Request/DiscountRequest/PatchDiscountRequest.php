<?php

namespace App\Request\DiscountRequest;

use App\Request\BaseRequest;

class PatchDiscountRequest extends BaseRequest
{
    #[Assert\Type('string')]
    private string|null $name = null;

    #[Assert\Type('float')]
    private float|null $percent = null;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float|null
     */
    public function getPercent(): ?float
    {
        return $this->percent;
    }

    /**
     * @param float|null $percent
     */
    public function setPercent(?float $percent): void
    {
        $this->percent = $percent;
    }
}
