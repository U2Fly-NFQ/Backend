<?php

namespace App\Controller\Discount;

use App\Entity\Discount;
use App\Repository\DiscountRepository;
use App\Request\AddDiscountRequest;
use App\Service\DiscountService;
use App\Traits\JsonTrait;
use App\Transformer\DiscountTransformer;
use App\Validation\RequestValidation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DiscountsController extends AbstractController
{
    use JsonTrait;

    #[Route('/api/discounts/{id}', name: 'app_discounts', methods: 'GET')]
    public function findById(int $id, DiscountRepository $discountRepository, DiscountTransformer $discountTransformer): JsonResponse
    {
        $discount = $discountRepository->find($id);
        if($discount == null){
            return $this->error([]);
        }
        $data = $discountTransformer->toArray($discount);
        
        return $this->success($data);
    }

    #[Route('/api/discounts', name: 'app_list_discounts', methods: 'GET')]
    public function list(DiscountRepository $discountRepository, DiscountTransformer $discountTransformer): JsonResponse
    {
        $discounts = $discountRepository->findAll();
        $data = $discountTransformer->toArrayList($discounts);

        return $this->success($data);
    }

    #[Route('/api/discounts', name: 'app_add_discounts', methods: 'POST')]
    public function add(Request $request,
                        AddDiscountRequest $addDiscountRequest,
                        DiscountService $discountService,
                        RequestValidation $requestValidation,
                        DiscountTransformer $discountTransformer): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);
        $discountRequest = $addDiscountRequest->fromArray($requestBody);
        $requestValidation->validate($discountRequest);
        $discountService->add($discountRequest);

        return $this->success([]);
    }
}
