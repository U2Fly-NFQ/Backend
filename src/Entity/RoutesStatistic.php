<?php

namespace App\Entity;

use App\Repository\RoutesStatisticRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoutesStatisticRepository::class)]
class RoutesStatistic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $arrival;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $departure;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $times;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArrival(): ?string
    {
        return $this->arrival;
    }

    public function setArrival(?string $arrival): self
    {
        $this->arrival = $arrival;

        return $this;
    }

    public function getDeparture(): ?string
    {
        return $this->departure;
    }

    public function setDeparture(?string $departure): self
    {
        $this->departure = $departure;

        return $this;
    }

    public function getTimes(): ?int
    {
        return $this->times;
    }

    public function setTimes(?int $times): self
    {
        $this->times = $times;

        return $this;
    }
}
