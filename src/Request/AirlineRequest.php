<?php

namespace App\Request;

use App\Entity\Airline;

class AirlineRequest
{
    #[Assert\NotBlank\Type('string')]
    private string $icao;

    #[Assert\NotBlank\Type('string')]
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

    /**
     * @param array $param
     * @return $this
     */
    public function fromArray(array $param): self
    {
        foreach ($param as $key => $request) {
            $action = 'set' . ucfirst($key);
            if (!method_exists($this, $action)) {
                continue;
            }

            $this->{$action}($request);
        }

        return $this;
    }
}
