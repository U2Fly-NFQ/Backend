<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class PatchCarRequest extends BaseRequest
{
    #[Assert\Type('string')]
    private $name;

    #[Assert\Type('string')]
    private $description;

    #[Assert\Type('string')]
    private $color;

    #[Assert\Type('string')]
    private $brand;

    #[Assert\Type('float')]
    private $price = null;

    #[Assert\Choice(choices: self::SEATS, message: 'Enter a valid seat type')]
    #[Assert\Type('integer')]
    private $seats;

    #[Assert\Type('integer')]
    private $year;

    #[Assert\Type('integer')]
    private $thumbnailId = null;

    #[Assert\Type('integer')]
    private $createdUserId = null;

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
     * @return null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param null $price
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
     * @return null
     */
    public function getThumbnailId()
    {
        return $this->thumbnailId;
    }

    /**
     * @param null $thumbnailId
     */
    public function setThumbnailId($thumbnailId): void
    {
        $this->thumbnailId = $thumbnailId;
    }

    /**
     * @return null
     */
    public function getCreatedUserId()
    {
        return $this->createdUserId;
    }

    /**
     * @param null $createdUserId
     */
    public function setCreatedUserId($createdUserId): void
    {
        $this->createdUserId = $createdUserId;
    }
}
