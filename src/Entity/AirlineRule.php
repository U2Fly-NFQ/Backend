<?php

namespace App\Entity;

use App\Repository\AirlineRuleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AirlineRuleRepository::class)]
class AirlineRule
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Airline::class, inversedBy: 'airlineRules')]
    #[ORM\JoinColumn(nullable: false)]
    private $airline;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Rule::class, inversedBy: 'airlineRules')]
    #[ORM\JoinColumn(nullable: false)]
    private $rule;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $deletedAt;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getRule(): ?Rule
    {
        return $this->rule;
    }

    public function setRule(?Rule $rule): self
    {
        $this->rule = $rule;

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
