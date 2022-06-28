<?php

namespace App\Entity;

use App\Repository\AirlineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AirlineRepository::class)]
class Airline
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\Column(type: 'string', length: 50)]
    private $country;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $description;

    #[ORM\OneToMany(mappedBy: 'airline', targetEntity: AirlineClass::class)]
    private $airlineClasses;

    #[ORM\OneToMany(mappedBy: 'airline', targetEntity: Flight::class)]
    private $flights;

    public function __construct()
    {
        $this->airlineClasses = new ArrayCollection();
        $this->flights = new ArrayCollection();
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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, AirlineClass>
     */
    public function getAirlineClasses(): Collection
    {
        return $this->airlineClasses;
    }

    public function addAirlineClass(AirlineClass $airlineClass): self
    {
        if (!$this->airlineClasses->contains($airlineClass)) {
            $this->airlineClasses[] = $airlineClass;
            $airlineClass->setAirline($this);
        }

        return $this;
    }

    public function removeAirlineClass(AirlineClass $airlineClass): self
    {
        if ($this->airlineClasses->removeElement($airlineClass)) {
            // set the owning side to null (unless already changed)
            if ($airlineClass->getAirline() === $this) {
                $airlineClass->setAirline(null);
            }
        }

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
            $flight->setAirline($this);
        }

        return $this;
    }

    public function removeFlight(Flight $flight): self
    {
        if ($this->flights->removeElement($flight)) {
            // set the owning side to null (unless already changed)
            if ($flight->getAirline() === $this) {
                $flight->setAirline(null);
            }
        }

        return $this;
    }
}
