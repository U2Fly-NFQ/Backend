<?php

namespace App\Entity;

use App\Repository\ClassTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassTypeRepository::class)]
class ClassType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'class', targetEntity: AirlineClass::class)]
    private $airlineClasses;

    public function __construct()
    {
        $this->airlineClasses = new ArrayCollection();
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
            $airlineClass->setClass($this);
        }

        return $this;
    }

    public function removeAirlineClass(AirlineClass $airlineClass): self
    {
        if ($this->airlineClasses->removeElement($airlineClass)) {
            // set the owning side to null (unless already changed)
            if ($airlineClass->getClass() === $this) {
                $airlineClass->setClass(null);
            }
        }

        return $this;
    }
}
