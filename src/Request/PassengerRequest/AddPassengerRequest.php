<?php

namespace App\Request\PassengerRequest;

use App\Request\BaseRequest;
use Symfony\Component\Validator\Constraints as Assert;

class AddPassengerRequest extends BaseRequest
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private string $name;

    #[Assert\Type('boolean')]
    private bool|null $gender = null;

    #[Assert\Type('string')]
    private string|null $birthday = null;

    #[Assert\Type('string')]
    private string|null $address = null;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private string $identification;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return bool|null
     */
    public function getGender(): ?bool
    {
        return $this->gender;
    }

    /**
     * @param bool|null $gender
     */
    public function setGender(?bool $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return string|null
     */
    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    /**
     * @param string|null $birthday
     */
    public function setBirthday(?string $birthday): void
    {
        $this->birthday = $birthday;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getIdentification(): string
    {
        return $this->identification;
    }

    /**
     * @param string $identification
     */
    public function setIdentification(string $identification): void
    {
        $this->identification = $identification;
    }
}
