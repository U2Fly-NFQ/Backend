<?php

namespace App\Entity;

use App\Repository\SeatTypeRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeatTypeRepository::class)]
class SeatType extends AbstractEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'seatType', targetEntity: Ticket::class)]
    private $tickets;

    #[ORM\OneToMany(mappedBy: 'seatType', targetEntity: AirplaneSeatType::class)]
    private $airplaneSeatTypes;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $deletedAt;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
        $this->airplaneSeatTypes = new ArrayCollection();
        $this->createdAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $ticket->setSeatType($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getSeatType() === $this) {
                $ticket->setSeatType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AirplaneSeatType>
     */
    public function getAirplaneSeatTypes(): Collection
    {
        return $this->airplaneSeatTypes;
    }

    public function addAirplaneSeatType(AirplaneSeatType $airplaneSeatType): self
    {
        if (!$this->airplaneSeatTypes->contains($airplaneSeatType)) {
            $this->airplaneSeatTypes[] = $airplaneSeatType;
            $airplaneSeatType->setSeatType($this);
        }

        return $this;
    }

    public function removeAirplaneSeatType(AirplaneSeatType $airplaneSeatType): self
    {
        if ($this->airplaneSeatTypes->removeElement($airplaneSeatType)) {
            // set the owning side to null (unless already changed)
            if ($airplaneSeatType->getSeatType() === $this) {
                $airplaneSeatType->setSeatType(null);
            }
        }

        return $this;
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
}
