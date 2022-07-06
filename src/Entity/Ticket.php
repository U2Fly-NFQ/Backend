<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket extends AbstractEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Passenger::class, inversedBy: 'tickets')]
    #[ORM\JoinColumn(nullable: false)]
    private $passenger;

    #[ORM\ManyToOne(targetEntity: Discount::class, inversedBy: 'tickets')]
    private $discount;

    #[ORM\Column(type: 'float')]
    private $totalPrice;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    #[ORM\ManyToOne(targetEntity: SeatType::class, inversedBy: 'tickets')]
    #[ORM\JoinColumn(nullable: false)]
    private $seatType;

    #[ORM\Column(type: 'string', length: 100)]
    private $ticketOwner;

    #[ORM\OneToMany(mappedBy: 'ticket', targetEntity: TicketFlight::class)]
    private $ticketFlights;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $status;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->ticketFlights = new ArrayCollection();
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
    public function getPassenger()
    {
        return $this->passenger;
    }

    /**
     * @param mixed $passenger
     */
    public function setPassenger($passenger): void
    {
        $this->passenger = $passenger;
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
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * @param mixed $totalPrice
     */
    public function setTotalPrice($totalPrice): void
    {
        $this->totalPrice = $totalPrice;
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
    public function getSeatType()
    {
        return $this->seatType;
    }

    /**
     * @param mixed $seatType
     */
    public function setSeatType($seatType): void
    {
        $this->seatType = $seatType;
    }

    /**
     * @return mixed
     */
    public function getTicketOwner()
    {
        return $this->ticketOwner;
    }

    /**
     * @param mixed $ticketOwner
     */
    public function setTicketOwner($ticketOwner): void
    {
        $this->ticketOwner = $ticketOwner;
    }

    /**
     * @return Collection
     */
    public function getTicketFlights(): Collection
    {
        return $this->ticketFlights;
    }

    /**
     * @param Collection $ticketFlights
     */
    public function setTicketFlights(Collection $ticketFlights): void
    {
        $this->ticketFlights = $ticketFlights;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
