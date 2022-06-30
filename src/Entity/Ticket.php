<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket extends AbstractEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Account::class, inversedBy: 'tickets')]
    #[ORM\JoinColumn(nullable: false)]
    private $account;

    #[ORM\ManyToOne(targetEntity: Discount::class, inversedBy: 'tickets')]
    private $discount;

    #[ORM\Column(type: 'float')]
    private $totalPrice;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    #[ORM\ManyToOne(targetEntity: Flight::class, inversedBy: 'tickets')]
    #[ORM\JoinColumn(nullable: false)]
    private $flight;

    #[ORM\ManyToOne(targetEntity: SeatType::class, inversedBy: 'tickets')]
    #[ORM\JoinColumn(nullable: false)]
    private $seatType;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

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

    public function getDiscount(): ?Discount
    {
        return $this->discount;
    }

    public function setDiscount(?Discount $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @param mixed $totalPrice
     */
    public function setTotalPrice(float $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
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

    public function getFlight(): ?Flight
    {
        return $this->flight;
    }

    public function setFlight(?Flight $flight): self
    {
        $this->flight = $flight;

        return $this;
    }

    public function getSeatType(): ?SeatType
    {
        return $this->seatType;
    }

    public function setSeatType(?SeatType $seatType): self
    {
        $this->seatType = $seatType;

        return $this;
    }
}
