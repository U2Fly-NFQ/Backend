<?php

namespace App\Entity;

use App\Repository\AirlineRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AirlineRepository::class)]
class Airline extends AbstractEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 10)]
    private $icao;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    #[ORM\OneToMany(mappedBy: 'airline', targetEntity: Airplane::class)]
    private $airplanes;

    #[ORM\OneToMany(mappedBy: 'airline', targetEntity: AirlineRule::class)]
    private $airlineRules;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $deletedAt;

    #[ORM\OneToOne(inversedBy: 'airline', targetEntity: Image::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $image;

    public function __construct()
    {
        $this->airplanes = new ArrayCollection();
        $this->createdAt = new DateTime();
        $this->airlineRules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIcao(): ?string
    {
        return $this->icao;
    }

    public function setIcao(string $icao): self
    {
        $this->icao = $icao;

        return $this;
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
     * @return Collection<int, Airplane>
     */
    public function getAirplanes(): Collection
    {
        return $this->airplanes;
    }

    public function addAirplane(Airplane $airplane): self
    {
        if (!$this->airplanes->contains($airplane)) {
            $this->airplanes[] = $airplane;
            $airplane->setAirline($this);
        }

        return $this;
    }

    public function removeAirplane(Airplane $airplane): self
    {
        if ($this->airplanes->removeElement($airplane)) {
            // set the owning side to null (unless already changed)
            if ($airplane->getAirline() === $this) {
                $airplane->setAirline(null);
            }
        }

        return $this;
    }
    /**
     * @return Collection<int, AirlineRule>
     */
    public function getAirlineRules(): Collection
    {
        return $this->airlineRules;
    }

    public function addAirlineRule(AirlineRule $airlineRule): self
    {
        if (!$this->airlineRules->contains($airlineRule)) {
            $this->airlineRules[] = $airlineRule;
            $airlineRule->setAirline($this);
        }

        return $this;
    }

    public function removeAirlineRule(AirlineRule $airlineRule): self
    {
        if ($this->airlineRules->removeElement($airlineRule)) {
            // set the owning side to null (unless already changed)
            if ($airlineRule->getAirline() === $this) {
                $airlineRule->setAirline(null);
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

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(Image $image): self
    {
        $this->image = $image;

        return $this;
    }

}
