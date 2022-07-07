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

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $deletedAt;

    #[ORM\OneToMany(mappedBy: 'seatType', targetEntity: FlightSeatType::class)]
    private $flightSeatTypes;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
        $this->createdAt = new DateTime();
        $this->flightSeatTypes = new ArrayCollection();
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return ArrayCollection
     */
    public function getTickets(): ArrayCollection
    {
        return $this->tickets;
    }

    /**
     * @param ArrayCollection $tickets
     */
    public function setTickets(ArrayCollection $tickets): void
    {
        $this->tickets = $tickets;
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
     * @return Collection<int, FlightSeatType>
     */
    public function getFlightSeatTypes(): Collection
    {
        return $this->flightSeatTypes;
    }

    public function addFlightSeatType(FlightSeatType $flightSeatType): self
    {
        if (!$this->flightSeatTypes->contains($flightSeatType)) {
            $this->flightSeatTypes[] = $flightSeatType;
            $flightSeatType->setSeatType($this);
        }

        return $this;
    }

    public function removeFlightSeatType(FlightSeatType $flightSeatType): self
    {
        if ($this->flightSeatTypes->removeElement($flightSeatType)) {
            // set the owning side to null (unless already changed)
            if ($flightSeatType->getSeatType() === $this) {
                $flightSeatType->setSeatType(null);
            }
        }

        return $this;
    }
}
