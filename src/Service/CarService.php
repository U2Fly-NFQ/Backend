<?php

namespace App\Service;

use App\Entity\Car;
use App\Mapper\AddCarRequestToCar;
use App\Mapper\PatchCarRequestToCar;
use App\Mapper\PutCarRequestToCar;
use App\Repository\CarRepository;
use App\Request\AddCarRequest;
use App\Request\CarRequest;
use App\Request\PatchCarRequest;
use App\Request\PutCarRequest;

class CarService
{
    private CarRepository $carRepository;
    private AddCarRequestToCar $addCarRequestToCar;
    private PutCarRequestToCar $putCarRequestToCar;
    private PatchCarRequestToCar $patchCarRequestToCar;

    public function __construct(CarRepository        $carRepository,
                                AddCarRequestToCar   $addCarRequestToCar,
                                PutCarRequestToCar   $putCarRequestToCar,
                                PatchCarRequestToCar $patchCarRequestToCar
    )
    {
        $this->addCarRequestToCar = $addCarRequestToCar;
        $this->carRepository = $carRepository;
        $this->putCarRequestToCar = $putCarRequestToCar;
        $this->patchCarRequestToCar = $patchCarRequestToCar;
    }

    public function findAll(CarRequest $carRequest)
    {
        return $this->carRepository->getAll($carRequest);
    }

    public function add(AddCarRequest $addCarRequest): Car
    {
        $car = $this->addCarRequestToCar->mapper($addCarRequest);
        $this->carRepository->add($car, true);
        return $car;
    }

    public function putCar(PutCarRequest $putCarRequest, Car $car): Car
    {
        $this->putCarRequestToCar->mapping($putCarRequest, $car);
        $this->carRepository->add($car, true);

        return $car;
    }

    public function patchCar(PatchCarRequest $patchCarRequest, Car $car): Car
    {
        $this->patchCarRequestToCar->mapping($patchCarRequest, $car);
        $this->carRepository->add($car, true);
        return $car;
    }

}
