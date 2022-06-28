<?php

namespace App\Entity;

use App\Repository\FlightRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FlightRepository::class)]
class Flight
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $arrivalAirport;

    #[ORM\Column(type: 'string', length: 100)]
    private $departureAirport;

    #[ORM\Column(type: 'datetime')]
    private $startTime;

    #[ORM\Column(type: 'float')]
    private $duration;

    #[ORM\Column(type: 'string', length: 20)]
    private $code;

    #[ORM\ManyToOne(targetEntity: Airline::class, inversedBy: 'flights')]
    #[ORM\JoinColumn(nullable: false)]
    private $airline;

    #[ORM\ManyToOne(targetEntity: Discount::class, inversedBy: 'flights')]
    #[ORM\JoinColumn(nullable: true)]
    private $discount;

    #[ORM\OneToMany(mappedBy: 'flight', targetEntity: Ticket::class)]
    private $tickets;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArrivalAirport(): ?string
    {
        return $this->arrivalAirport;
    }

    public function setArrivalAirport(string $arrivalAirport): self
    {
        $this->arrivalAirport = $arrivalAirport;

        return $this;
    }

    public function getDepartureAirport(): ?string
    {
        return $this->departureAirport;
    }

    public function setDepartureAirport(string $departureAirport): self
    {
        $this->departureAirport = $departureAirport;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getDuration(): ?float
    {
        return $this->duration;
    }

    public function setDuration(float $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

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
     * @return Collection<int, Ticket>
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): self
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets[] = $ticket;
            $ticket->setFlight($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getFlight() === $this) {
                $ticket->setFlight(null);
            }
        }

        return $this;
    }
}
