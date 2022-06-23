<?php

namespace App\Mapper;

use App\Entity\Car;
use App\Repository\ImageRepository;
use App\Repository\UserRepository;
use App\Request\PutCarRequest;

class PutCarRequestToCar
{
    private ImageRepository $imageRepository;
    private UserRepository $userRepository;

    public function __construct(ImageRepository $imageRepository, UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->imageRepository = $imageRepository;
    }

    public function mapping(PutCarRequest $putCarRequest, Car $car): Car
    {
        $car->setName($putCarRequest->getName());
        $car->setBrand($putCarRequest->getBrand());
        $car->setColor($putCarRequest->getColor());
        $car->setPrice($putCarRequest->getPrice());
        $car->setDescription($putCarRequest->getDescription());
        $car->setYear($putCarRequest->getYear());
        $car->setSeats($putCarRequest->getSeats());
        $thumbnail = $this->imageRepository->find($putCarRequest->getThumbnailId());
        $car->setThumbnail($thumbnail);
        $createdUser = $this->userRepository->find($putCarRequest->getCreatedUserId());
        $car->setCreatedUser($createdUser);

        return $car;
    }
}
