<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

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

    #[ORM\ManyToOne(targetEntity: Flight::class, inversedBy: 'tickets')]
    #[ORM\JoinColumn(nullable: false)]
    private $flight;

    #[ORM\ManyToOne(targetEntity: SeatType::class, inversedBy: 'tickets')]
    #[ORM\JoinColumn(nullable: false)]
    private $seatType;

    #[ORM\Column(type: 'string', length: 100)]
    private $ticketOwner;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $cancelAt;

    #[ORM\OneToMany(mappedBy: 'ticket', targetEntity: TicketFlight::class)]
    private $ticketFlights;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->ticketFlights = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDiscount(): ?Discount
    {
        return $this->discount;
    }

    public function setDiscount(?Discount $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @param mixed $totalPrice
     */
    public function setTotalPrice(float $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
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

    public function getFlight(): ?Flight
    {
        return $this->flight;
    }

    public function setFlight(?Flight $flight): self
    {
        $this->flight = $flight;

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

    public function getTicketOwner(): ?string
    {
        return $this->ticketOwner;
    }

    public function setTicketOwner(string $ticketOwner): self
    {
        $this->ticketOwner = $ticketOwner;

        return $this;
    }

    public function getCancelAt(): ?\DateTimeInterface
    {
        return $this->cancelAt;
    }

    public function setCancelAt(\DateTimeInterface $cancelAt): self
    {
        $this->cancelAt = $cancelAt;

        return $this;
    }

    /**
     * @return Collection<int, TicketFlight>
     */
    public function getTicketFlights(): Collection
    {
        return $this->ticketFlights;
    }

    public function addTicketFlight(TicketFlight $ticketFlight): self
    {
        if (!$this->ticketFlights->contains($ticketFlight)) {
            $this->ticketFlights[] = $ticketFlight;
            $ticketFlight->setTicket($this);
        }

        return $this;
    }

    public function removeTicketFlight(TicketFlight $ticketFlight): self
    {
        if ($this->ticketFlights->removeElement($ticketFlight)) {
            // set the owning side to null (unless already changed)
            if ($ticketFlight->getTicket() === $this) {
                $ticketFlight->setTicket(null);
            }
        }

        return $this;
    }
}
