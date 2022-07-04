<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image extends AbstractEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 600)]
    private $path;

    #[ORM\OneToOne(mappedBy: 'image', targetEntity: Account::class, cascade: ['persist', 'remove'])]
    private $account;

    #[ORM\OneToOne(mappedBy: 'image', targetEntity: Airline::class, cascade: ['persist', 'remove'])]
    private $airline;

    #[ORM\OneToOne(mappedBy: 'image', targetEntity: Airport::class, cascade: ['persist', 'remove'])]
    private $airport;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(Account $account): self
    {
        // set the owning side of the relation if necessary
        if ($account->getImage() !== $this) {
            $account->setImage($this);
        }

        $this->account = $account;

        return $this;
    }

    public function getAirline(): ?Airline
    {
        return $this->airline;
    }

    public function setAirline(Airline $airline): self
    {
        // set the owning side of the relation if necessary
        if ($airline->getImage() !== $this) {
            $airline->setImage($this);
        }

        $this->airline = $airline;

        return $this;
    }

    public function getAirport(): ?Airport
    {
        return $this->airport;
    }

    public function setAirport(Airport $airport): self
    {
        // set the owning side of the relation if necessary
        if ($airport->getImage() !== $this) {
            $airport->setImage($this);
        }

        $this->airport = $airport;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
