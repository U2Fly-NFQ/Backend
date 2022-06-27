<?php

namespace App\Entity;

use App\Repository\AirlineClassRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AirlineClassRepository::class)]
class AirlineClass
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float')]
    private $price;

    #[ORM\Column(type: 'integer')]
    private $seatAvailable;

    #[ORM\ManyToOne(targetEntity: ClassType::class, inversedBy: 'airlineClasses')]
    #[ORM\JoinColumn(nullable: false)]
    private $class;

    #[ORM\ManyToOne(targetEntity: Airline::class, inversedBy: 'airlineClasses')]
    #[ORM\JoinColumn(nullable: false)]
    private $airline;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getSeatAvailable(): ?int
    {
        return $this->seatAvailable;
    }

    public function setSeatAvailable(int $seatAvailable): self
    {
        $this->seatAvailable = $seatAvailable;

        return $this;
    }

    public function getClass(): ?ClassType
    {
        return $this->class;
    }

    public function setClass(?ClassType $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getAirline(): ?Airline
    {
        return $this->airline;
    }

    public function setAirline(?Airline $airline): self
    {
        $this->airline = $airline;

        return $this;
    }
}
