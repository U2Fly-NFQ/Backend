<?php

namespace App\Controller\API\Car;

use App\Service\CarService;
use App\Traits\JsonResponseTrait;
use App\Transformer\CarTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Request\CarRequest;
use Symfony\Component\HttpFoundation\Request;

#[Route('/api', name: 'api_')]
class CarController extends AbstractController
{
    use JsonResponseTrait;

    #[Route('/cars', name: 'car_index')]
    public function index(
        CarTransformer $carTransformer,
        CarRequest     $carRequest,
        Request        $request,
        CarService     $carService
    ): JsonResponse
    {
        $params = $request->query->all();
        $carData = $carRequest->fromArray($params);
        $cars = $carService->findAll($carData);
        $data = $carTransformer->toArray($cars);

        return $this->success($data);
    }

}
