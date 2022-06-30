<?php

namespace App\Controller\Discount;

use App\Entity\Discount;
use App\Repository\DiscountRepository;
use App\Traits\JsonTrait;
use App\Transformer\DiscountTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
}
