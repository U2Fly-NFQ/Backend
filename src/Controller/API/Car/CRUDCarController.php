<?php

namespace App\Controller\API\Car;


use App\Entity\Car;
use App\Repository\CarRepository;
use App\Request\AddCarRequest;
use App\Request\PatchCarRequest;
use App\Request\PutCarRequest;
use App\Service\CarService;
use App\Traits\JsonResponseTrait;
use App\Transformer\CarTransformer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api', name: 'api_')]
class CRUDCarController extends AbstractController
{
    use JsonResponseTrait;

    const BAD_REQUEST_MESSAGE = "Something got wrong with your inputs!!";
    const FORBIDDEN_REQUEST_MESSAGE = "get out of here! USER!";

    #[IsGranted('ROLE_ADMIN', message: self::FORBIDDEN_REQUEST_MESSAGE, statusCode: Response::HTTP_FORBIDDEN)]
    #[Route('/add', name: 'crud_add', methods: 'POST')]
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
            return $this->error($errors);
        }
        $car = $carService->add($carRequest);
        $car = $carTransformer->objectToArray($car);

        return $this->success($car, Response::HTTP_CREATED);
    }

    #[IsGranted('ROLE_ADMIN', message: self::FORBIDDEN_REQUEST_MESSAGE, statusCode: Response::HTTP_FORBIDDEN)]
    #[Route('/update/{id}', name: 'crud_update', methods: ['PUT'])]
    public function updatePut(
        int                $id,
        Request            $request,
        CarService         $carService,
        CarRepository      $carRepository,
        PutCarRequest      $putCarRequest,
        ValidatorInterface $validator
    ): JsonResponse
    {
        $car = $this->checkCarId($id, $carRepository);
        $requestArray = json_decode($request->getContent(), true);
        $carRequest = $putCarRequest->fromArray($requestArray);
        $errors = $validator->validate($carRequest);
        if (count($errors) > 0) {
            return $this->error($errors);
        }
        $carService->putCar($putCarRequest, $car);

        return $this->success([], Response::HTTP_NO_CONTENT);
    }

    #[IsGranted('ROLE_ADMIN', message: self::FORBIDDEN_REQUEST_MESSAGE, statusCode: Response::HTTP_FORBIDDEN)]
    #[Route('/update/{id}', name: 'crud_update_patch', methods: ['PATCH'])]
    public function updatePatch(
        int                $id,
        CarRepository      $carRepository,
        Request            $request,
        PatchCarRequest    $patchCarRequest,
        ValidatorInterface $validator,
        CarService         $carService
    ): JsonResponse
    {
        $car = $this->checkCarId($id, $carRepository);
        $requestArray = json_decode($request->getContent(), true);
        $carRequest = $patchCarRequest->fromArray($requestArray);
        $errors = $validator->validate($carRequest);
        if (count($errors) > 0) {
            return $this->error($errors);
        }
        $carService->patchCar($patchCarRequest, $car);

        return $this->success([], Response::HTTP_NO_CONTENT);
    }

    #[IsGranted('ROLE_ADMIN', message: self::FORBIDDEN_REQUEST_MESSAGE, statusCode: Response::HTTP_FORBIDDEN)]
    #[Route('/delete/{id}', name: 'crud_delete', methods: ['DELETE'])]
    public function deleteCar(
        int           $id,
        CarService    $carService,
        CarRepository $carRepository
    ): JsonResponse
    {
        $car = $this->checkCarId($id, $carRepository);
        $carService->deleteCar($car);
        return $this->success([], Response::HTTP_NO_CONTENT);
    }

    private function checkCarId(int $id, CarRepository $carRepository): Car
    {
        $car = $carRepository->find($id);
        if ($car === null) {
            throw new ValidatorException(self::BAD_REQUEST_MESSAGE);
        }
        return $car;
    }

}
