<?php

namespace App\Controller\API\Car;

use App\Entity\Car;
use App\Repository\CarRepository;
use App\Request\AddCarRequest;
use App\Request\PutCarRequest;
use App\Service\CarService;
use App\Traits\JsonResponseTrait;
use App\Transformer\CarTransformer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Request\CarRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CarController extends AbstractController
{
    use JsonResponseTrait;

    #[Route('/api/cars', name: 'api_car_index')]
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

    #[IsGranted('ROLE_ADMIN', message: 'get out of here! USER!', statusCode: Response::HTTP_FORBIDDEN)]
    #[Route('/api/add', name: 'add_car', methods: 'POST')]
    public function addCar(
        Request            $request,
        AddCarRequest      $addCarRequest,
        CarTransformer     $carTransformer,
        CarService         $carService,
        ValidatorInterface $validator
    ): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);
        $carRequest = $addCarRequest->fromArray($requestBody);
        $errors = $validator->validate($carRequest);
        if (count($errors) > 0) {
            throw new ValidatorException("Something got wrong with your inputs!!");
        }
        $car = $carService->add($carRequest);
        $car = $carTransformer->objectToArray($car);

        return $this->success([], Response::HTTP_CREATED);
    }

    #[IsGranted('ROLE_ADMIN', message: 'get out of here! USER!', statusCode: Response::HTTP_FORBIDDEN)]
    #[Route('/api/update/{id}', name: 'update', methods: ['PUT'])]
    public function updatePut(
        int                $id,
        CarService         $carService,
        CarRepository      $carRepository,
        PutCarRequest      $putCarRequest,
        Request            $request,
        ValidatorInterface $validator
    )
    {
        $car = $this->checkCarId($id, $carRepository);
        $array = json_decode($request->getContent(), true);
        $putCarRequest->fromArray($array);
        $errors = $validator->validate($putCarRequest);
        if (count($errors) > 0) {
            throw new ValidatorException("Something got wrong with your inputs!!");
        }
        $carService->putCar($putCarRequest, $car);

        return $this->success([], Response::HTTP_OK);
    }

    private function checkCarId(int $id, CarRepository $carRepository): Car
    {
        $car = $carRepository->find($id);
        if ($car === null) {
            throw new ValidatorException(code: Response::HTTP_BAD_REQUEST);
        }
        return $car;
    }

}
