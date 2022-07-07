<?php

namespace App\Entity;

use App\Repository\FlightSeatTypeRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FlightSeatTypeRepository::class)]
class FlightSeatType extends AbstractEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Flight::class, inversedBy: 'flightSeatTypes')]
    #[ORM\JoinColumn(nullable: false)]
    private $flight;

    #[ORM\ManyToOne(targetEntity: SeatType::class, inversedBy: 'flightSeatTypes')]
    #[ORM\JoinColumn(nullable: false)]
    private $seatType;

    #[ORM\Column(type: 'float')]
    private $price;

    #[ORM\Column(type: 'integer')]
    private $seatAvailable;

    #[ORM\Column(type: 'float')]
    private $discount;

    #[ORM\Column(type: 'float')]
    private $luggageWeight;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $deletedAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getSeatAvailable()
    {
        return $this->seatAvailable;
    }

    /**
     * @param mixed $seatAvailable
     */
    public function setSeatAvailable($seatAvailable): void
    {
        $this->seatAvailable = $seatAvailable;
    }

    /**
     * @return mixed
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param mixed $discount
     */
    public function setDiscount($discount): void
    {
        $this->discount = $discount;
    }

    /**
     * @return mixed
     */
    public function getLuggageWeight()
    {
        return $this->luggageWeight;
    }

    /**
     * @param mixed $luggageWeight
     */
    public function setLuggageWeight($luggageWeight): void
    {
        $this->luggageWeight = $luggageWeight;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @param mixed $deletedAt
     */
    public function setDeletedAt($deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * @return mixed
     */
    public function getFlight()
    {
        return $this->flight;
    }

    /**
     * @param mixed $flight
     */
    public function setFlight($flight): void
    {
        $this->flight = $flight;
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
}
