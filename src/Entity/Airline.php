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

    #[ORM\OneToMany(mappedBy: 'airline', targetEntity: Airplane::class)]
    private $airplanes;

    #[ORM\OneToMany(mappedBy: 'airline', targetEntity: AirlineRule::class)]
    private $airlineRules;

    #[ORM\OneToOne(inversedBy: 'airline', targetEntity: Image::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    private $image;

    #[ORM\OneToMany(mappedBy: 'airline', targetEntity: Rating::class, orphanRemoval: true)]
    private $airline;

    #[ORM\Column(type: 'float', nullable: true)]
    private $rating;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $numberRating;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $deletedAt;

    public function __construct()
    {
        $this->airplanes = new ArrayCollection();
        $this->createdAt = new DateTime();
        $this->airlineRules = new ArrayCollection();
        $this->image = null;
        $this->airline = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getIcao(): mixed
    {
        return $this->icao;
    }

    /**
     * @param mixed $icao
     */
    public function setIcao(mixed $icao): void
    {
        $this->icao = $icao;
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

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return Collection<int, Rating>
     */
    public function getAirline(): Collection
    {
        return $this->airline;
    }

    public function addAirline(Rating $airline): self
    {
        if (!$this->airline->contains($airline)) {
            $this->airline[] = $airline;
            $airline->setAirline($this);
        }

        return $this;
    }

    public function removeAirline(Rating $airline): self
    {
        if ($this->airline->removeElement($airline)) {
            // set the owning side to null (unless already changed)
            if ($airline->getAirline() === $this) {
                $airline->setAirline(null);
            }
        }

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(?float $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getNumberRating(): ?int
    {
        return $this->numberRating;
    }

    public function setNumberRating(?int $numberRating): self
    {
        $this->numberRating = $numberRating;

        return $this;
    }
}
