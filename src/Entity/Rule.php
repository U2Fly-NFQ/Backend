<?php

namespace App\Entity;

use App\Repository\RuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RuleRepository::class)]
class Rule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'rule', targetEntity: AirlineRule::class)]
    private $airlineRules;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $deletedAt;

    public function __construct()
    {
        $this->airlineRules = new ArrayCollection();
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
            $airlineRule->setRule($this);
        }

        return $this;
    }

    public function removeAirlineRule(AirlineRule $airlineRule): self
    {
        if ($this->airlineRules->removeElement($airlineRule)) {
            // set the owning side to null (unless already changed)
            if ($airlineRule->getRule() === $this) {
                $airlineRule->setRule(null);
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
