<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Airline;

class AirlineRequest extends BaseRequest
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private string $icao;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private string $name;

    /**
     * @return string
     */
    public function getIcao(): string
    {
        return $this->icao;
    }

    /**
     * @param string $icao
     */
    public function setIcao(string $icao): void
    {
        $this->icao = $icao;
    }

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
}
