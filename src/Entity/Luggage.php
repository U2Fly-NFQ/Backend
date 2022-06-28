<?php

namespace App\Entity;

use App\Repository\LuggageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LuggageRepository::class)]
class Luggage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Account::class, inversedBy: 'luggage')]
    #[ORM\JoinColumn(nullable: false)]
    private $account;

    #[ORM\Column(type: 'float')]
    private $weight;

    #[ORM\Column(type: 'datetime')]
    private $takenTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(?Account $account): self
    {
        $this->account = $account;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getTakenTime(): ?\DateTimeInterface
    {
        return $this->takenTime;
    }

    public function setTakenTime(\DateTimeInterface $takenTime): self
    {
        $this->takenTime = $takenTime;

        return $this;
    }
}
