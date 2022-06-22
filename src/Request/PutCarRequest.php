<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class PutCarRequest extends BaseRequest
{
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
    private $price;

    #[Assert\Choice(choices: self::SEATS, message: 'Enter a valid seat type')]
    #[Assert\Type('integer')]
    #[Assert\NotNull]
    private $seats;

    #[Assert\Type('integer')]
    #[Assert\NotNull]
    private $year;

    #[Assert\Type('integer')]
    private int $thumbnailId;

    #[Assert\Type('integer')]
    #[Assert\NotNull]
    private $createdUserId;

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
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * @param mixed $seats
     */
    public function setSeats($seats): void
    {
        $this->seats = $seats;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year): void
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
     * @return mixed
     */
    public function getCreatedUserId()
    {
        return $this->createdUserId;
    }

    /**
     * @param mixed $createdUserId
     */
    public function setCreatedUserId($createdUserId): void
    {
        $this->createdUserId = $createdUserId;
    }

}
