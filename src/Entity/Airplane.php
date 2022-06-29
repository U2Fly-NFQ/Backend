<?php

namespace App\Entity;

use App\Repository\AirplaneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AirplaneRepository::class)]
class Airplane extends AbstractEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    #[ORM\OneToMany(mappedBy: 'airplane', targetEntity: Flight::class)]
    private $flights;

    #[ORM\ManyToOne(targetEntity: Airline::class, inversedBy: 'airplanes')]
    #[ORM\JoinColumn(nullable: false)]
    private $airline;

    #[ORM\OneToMany(mappedBy: 'airplane', targetEntity: AirplaneSeatType::class)]
    private $airplaneSeatTypes;

    public function __construct()
    {
        $this->flights = new ArrayCollection();
        $this->airplaneSeatTypes = new ArrayCollection();
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
     * @return Collection<int, Flight>
     */
    public function getFlights(): Collection
    {
        return $this->flights;
    }

    public function addFlight(Flight $flight): self
    {
        if (!$this->flights->contains($flight)) {
            $this->flights[] = $flight;
            $flight->setAirplane($this);
        }

        return $this;
    }

    public function removeFlight(Flight $flight): self
    {
        if ($this->flights->removeElement($flight)) {
            // set the owning side to null (unless already changed)
            if ($flight->getAirplane() === $this) {
                $flight->setAirplane(null);
            }
        }

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
            $airplaneSeatType->setAirplane($this);
        }

        return $this;
    }

    public function removeAirplaneSeatType(AirplaneSeatType $airplaneSeatType): self
    {
        if ($this->airplaneSeatTypes->removeElement($airplaneSeatType)) {
            // set the owning side to null (unless already changed)
            if ($airplaneSeatType->getAirplane() === $this) {
                $airplaneSeatType->setAirplane(null);
            }
        }

        return $this;
    }
}
