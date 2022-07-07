<?php

namespace App\Entity;

use App\Repository\FlightRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FlightRepository::class)]
class Flight extends AbstractEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'flight', targetEntity: FlightSeatType::class)]
    private $flightSeatTypes;

    #[ORM\ManyToOne(targetEntity: Airplane::class, inversedBy: 'flights')]
    #[ORM\JoinColumn(nullable: false)]
    private $airplane;

    #[ORM\OneToMany(mappedBy: 'flight', targetEntity: TicketFlight::class)]
    private $ticketFlights;

    #[ORM\Column(type: 'string', length: 10)]
    private $code;

    #[ORM\Column(type: 'string', length: 100)]
    private $arrival;

    #[ORM\Column(type: 'string', length: 100)]
    private $departure;

    #[ORM\Column(type: 'time')]
    private $startTime;

    #[ORM\Column(type: 'date')]
    private $startDate;

    #[ORM\Column(type: 'float')]
    private $duration;

    #[ORM\Column(type: 'boolean')]
    private $isRefund;


    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $deletedAt;


    public function __construct()
    {
        $this->ticketFlights = new ArrayCollection();
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
     * @return ArrayCollection
     */
    public function getFlightSeatTypes(): ArrayCollection
    {
        return $this->flightSeatTypes;
    }

    /**
     * @param ArrayCollection $flightSeatTypes
     */
    public function setFlightSeatTypes(ArrayCollection $flightSeatTypes): void
    {
        $this->flightSeatTypes = $flightSeatTypes;
    }

    /**
     * @return mixed
     */
    public function getAirplane()
    {
        return $this->airplane;
    }

    /**
     * @param mixed $airplane
     */
    public function setAirplane($airplane): void
    {
        $this->airplane = $airplane;
    }

    /**
     * @return ArrayCollection
     */
    public function getTicketFlights(): ArrayCollection
    {
        return $this->ticketFlights;
    }

    /**
     * @param ArrayCollection $ticketFlights
     */
    public function setTicketFlights(ArrayCollection $ticketFlights): void
    {
        $this->ticketFlights = $ticketFlights;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code): void
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getArrival()
    {
        return $this->arrival;
    }

    /**
     * @param mixed $arrival
     */
    public function setArrival($arrival): void
    {
        $this->arrival = $arrival;
    }

    /**
     * @return mixed
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * @param mixed $departure
     */
    public function setDeparture($departure): void
    {
        $this->departure = $departure;
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param mixed $startTime
     */
    public function setStartTime($startTime): void
    {
        $this->startTime = $startTime;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getIsRefund()
    {
        return $this->isRefund;
    }

    /**
     * @param mixed $isRefund
     */
    public function setIsRefund($isRefund): void
    {
        $this->isRefund = $isRefund;
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
}
