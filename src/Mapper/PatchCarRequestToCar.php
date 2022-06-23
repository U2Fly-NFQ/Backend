<?php

namespace App\Mapper;

use App\Entity\Car;
use App\Repository\ImageRepository;
use App\Repository\UserRepository;
use App\Request\PatchCarRequest;

class PatchCarRequestToCar
{
    private ImageRepository $imageRepository;
    private UserRepository $userRepository;

    public function __construct(ImageRepository $imageRepository, UserRepository $userRepository)
    {
        $this->imageRepository = $imageRepository;
        $this->userRepository = $userRepository;
    }

    public function mapping(PatchCarRequest $patchCarRequest, Car $car): Car
    {
        $createdUserId = $patchCarRequest->getCreatedUserId();
        if ($createdUserId !== null) {
            $createdUser = $this->userRepository->find($createdUserId);
            $car->setCreatedUser($createdUser);
        }
        $thumbnailId = $patchCarRequest->getThumbnailId();
        if ($thumbnailId !== null) {
            $thumbnail = $this->imageRepository->find($thumbnailId);
            $car->setThumbnail($thumbnail);
        }
        $car->setName($patchCarRequest->getName() ?? $car->getName())
            ->setDescription($patchCarRequest->getDescription() ?? $car->getDescription())
            ->setColor($patchCarRequest->getColor() ?? $car->getColor())
            ->setBrand($patchCarRequest->getBrand() ?? $car->getBrand())
            ->setPrice($patchCarRequest->getPrice() ?? $car->getPrice())
            ->setSeats($patchCarRequest->getSeats() ?? $car->getSeats())
            ->setYear($patchCarRequest->getYear() ?? $car->getYear());

        return $car;
    }
}
