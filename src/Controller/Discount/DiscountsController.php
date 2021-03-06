<?php

namespace App\Controller\Discount;

use App\Constant\DiscountConstant;
use App\Constant\SecurityConstant;
use App\Entity\Discount;
use App\Repository\DiscountRepository;
use App\Request\AddDiscountRequest;
use App\Request\DiscountRequest\DeleteDiscountRequest;
use App\Request\DiscountRequest\PatchDiscountRequest;
use App\Service\DiscountService;
use App\Traits\JsonTrait;
use App\Transformer\DiscountTransformer;
use App\Validation\RequestValidation;
use DateTime;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DiscountsController extends AbstractController
{
    use JsonTrait;

    #[Route('/api/discounts/{name}', name: 'app_discounts', methods: 'GET')]
    public function findByName(
        string              $name,
        DiscountRepository  $discountRepository,
        DiscountTransformer $discountTransformer
    )
    {
        $discount = $discountRepository->findOneBy(['name' => $name]);
        if ($discount == null) {
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

    /**
     * @throws Exception
     */
    #[IsGranted('ROLE_ADMIN', message: SecurityConstant::ONLY_ADMIN_MESSAGE)]
    #[Route('/api/discounts', name: 'app_add_discounts', methods: 'POST')]
    public function add(
        Request             $request,
        AddDiscountRequest  $addDiscountRequest,
        DiscountService     $discountService,
        RequestValidation   $requestValidation,
        DiscountTransformer $discountTransformer
    ): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);
        $discountRequest = $addDiscountRequest->fromArray($requestBody);
        $requestValidation->validate($discountRequest);
        $discountService->add($discountRequest);

        return $this->success([]);
    }

    /**
     * @throws Exception
     */
    #[IsGranted('ROLE_ADMIN', message: SecurityConstant::ONLY_ADMIN_MESSAGE)]
    #[Route('/api/discounts/{id}', name: 'app_update_discounts', methods: 'PUT')]
    public function patch(
        int                  $id,
        Request              $request,
        PatchDiscountRequest $patchDiscountRequest,
        DiscountService      $discountService,
        RequestValidation    $requestValidation,
        DiscountRepository   $discountRepository,
    ): JsonResponse
    {
        $discount = $discountRepository->find($id);
        if (!$discount) {
            throw new Exception();
        }
        $requestBody = json_decode($request->getContent(), true);
        $discountRequest = $patchDiscountRequest->fromArray($requestBody);
        $requestValidation->validate($discountRequest);
        $discountService->patch($discountRequest, $discount);

        return $this->success([]);
    }

    /**
     * @throws Exception
     */
    #[IsGranted('ROLE_ADMIN', message: SecurityConstant::ONLY_ADMIN_MESSAGE)]
    #[Route('/api/discounts/{id}', name: 'app_delete_discounts', methods: 'DELETE')]
    public function delete(
        int                $id,
        DiscountRepository $discountRepository
    )
    {
        $discount = $discountRepository->find($id);
        if (!$discount) {
            throw new Exception(DiscountConstant::NO_DISCOUNT_MESSAGE);
        }
        if (!empty($discount->getDeletedAt())) {
            throw new Exception(DiscountConstant::ALREADY_DELETED_MESSAGE);
        }
        $discount->setDeletedAt(new DateTime());
        $discountRepository->add($discount, true);
        return $this->success([
            'message' => DiscountConstant::DELETED_MESSAGE
        ]);
    }
}
