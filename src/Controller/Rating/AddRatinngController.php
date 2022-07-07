<?php

namespace App\Controller\Rating;

use App\Request\RateRequest\AddRateRequest;
use App\Service\RateService;
use App\Traits\JsonTrait;
use App\Validation\RequestValidation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddRatinngController extends AbstractController
{
    use JsonTrait;

    /**
     * @param Request $request
     * @param AddRateRequest $addRateRequest
     * @param RateService $rateService
     * @param RequestValidation $requestValidation
     * @return Response
     * @throws \Exception
     */
    #[Route('/api/rate', name: 'app_add_rating', methods: 'POST')]
    public function add(
        Request $request,
        AddRateRequest $addRateRequest,
        RateService $rateService,
        RequestValidation $requestValidation
    ): Response {
        $bodyParam = json_decode($request->getContent(), true);
        $rateRequest = $addRateRequest->fromArray($bodyParam);
        $requestValidation->validate($rateRequest);
        $rateService->add($rateRequest);

        return $this->success([]);
    }
}
