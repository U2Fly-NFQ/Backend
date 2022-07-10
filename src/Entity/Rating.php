<?php

namespace App\Entity;

use App\Repository\RatingRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: RatingRepository::class)]
#[UniqueEntity(fields: ['account', 'flight'], message: 'user can not vote 2 times for a flight', errorPath: 'flight')]
class Rating
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Account::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $account;

    #[ORM\ManyToOne(targetEntity: Airline::class, inversedBy: 'airline')]
    #[ORM\JoinColumn(nullable: false)]
    private $airline;

    #[ORM\Column(type: 'integer')]
    private $rate;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $comment;

    #[ORM\ManyToOne(targetEntity: TicketFlight::class, inversedBy: 'rating')]
    private $ticketFlight;

    #[ORM\Column(type: 'datetime')]
    private $createAt;

    public function __construct()
    {
        $this->createAt = new DateTime();
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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

    public function getAirline(): ?Airline
    {
        return $this->airline;
    }

    public function setAirline(?Airline $airline): self
    {
        $this->airline = $airline;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getTicketFlight(): ?TicketFlight
    {
        return $this->ticketFlight;
    }

    public function setTicketFlight(?TicketFlight $ticketFlight): self
    {
        $this->ticketFlight = $ticketFlight;

        return $this;
    }
}
