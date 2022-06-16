<?php

namespace App\Controller\API\Car;

use App\Entity\Car;
use App\Repository\CarRepository;
use App\Traits\JsonResponseTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    use JsonResponseTrait;

    #[Route('/api/cars', name: 'api_car_index')]
    public function index(Car $car): JsonResponse
    {
        $allCars = $car->serialise();
        dd($allCars);
        return $this->success($allCars);
    }
}
