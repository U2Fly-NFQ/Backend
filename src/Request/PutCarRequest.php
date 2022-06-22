<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class PutCarRequest extends BaseRequest
{
    const SEATS = [4, 7, 16];

    #[Assert\Type('string')]
    #[Assert\NotNull]
    private $name;

    #[Assert\Type('string')]
    private $description;

    #[Assert\Type('string')]
    #[Assert\NotNull]
    private $color;

    #[Assert\Type('string')]
    #[Assert\NotNull]
    private $brand;

    #[Assert\Type('float')]
    #[Assert\NotNull]
    private float $price;

    #[Assert\Choice(choices: self::SEATS, message: 'Enter a valid seat type')]
    #[Assert\Type('integer')]
    #[Assert\NotNull]
    private int $seats;

    #[Assert\Type('integer')]
    #[Assert\NotNull]
    private int $year;

    #[Assert\Type('integer')]
    private int $thumbnailId;

    #[Assert\Type('integer')]
    #[Assert\NotNull]
    private int $createdUserId;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getSeats(): int
    {
        return $this->seats;
    }

    /**
     * @param int $seats
     */
    public function setSeats(int $seats): void
    {
        $this->seats = $seats;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    /**
     * @return int
     */
    public function getThumbnailId(): int
    {
        return $this->thumbnailId;
    }

    /**
     * @param int $thumbnailId
     */
    public function setThumbnailId(int $thumbnailId): void
    {
        $this->thumbnailId = $thumbnailId;
    }

    /**
     * @return int
     */
    public function getCreatedUserId(): int
    {
        return $this->createdUserId;
    }

    /**
     * @param int $createdUserId
     */
    public function setCreatedUserId(int $createdUserId): void
    {
        $this->createdUserId = $createdUserId;
    }

}
