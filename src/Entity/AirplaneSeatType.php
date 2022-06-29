<?php

namespace App\Entity;

use App\Repository\AirplaneSeatTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AirplaneSeatTypeRepository::class)]
class AirplaneSeatType
{

    #[ORM\Column(type: 'float')]
    private $price;

    #[ORM\Column(type: 'integer')]
    private $seatAvailable;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Airplane::class, inversedBy: 'airplaneSeatTypes')]
    #[ORM\JoinColumn(nullable: false)]
    private $airplane;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: SeatType::class, inversedBy: 'airplaneSeatTypes')]
    #[ORM\JoinColumn(nullable: false)]
    private $seatType;

    #[ORM\Column(type: 'float')]
    private $luggageWeight;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getAirplane(): ?Airplane
    {
        return $this->airplane;
    }

    public function setAirplane(?Airplane $airplane): self
    {
        $this->airplane = $airplane;

        return $this;
    }

    public function getSeatType(): ?SeatType
    {
        return $this->seatType;
    }

    public function setSeatType(?SeatType $seatType): self
    {
        $this->seatType = $seatType;

        return $this;
    }

    public function getLuggageWeight(): ?float
    {
        return $this->luggageWeight;
    }

    public function setLuggageWeight(float $luggageWeight): self
    {
        $this->luggageWeight = $luggageWeight;

        return $this;
    }
}
