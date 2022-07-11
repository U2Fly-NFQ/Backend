<?php

namespace App\Controller\Register;

use App\Constant\ErrorsConstant;
use App\Entity\AbstractEntity;
use App\Entity\Account;
use App\Entity\Passenger;
use App\Repository\PassengerRepository;
use App\Request\AddAccountRequest;
use App\Request\PassengerRequest\AddPassengerRequest;
use App\Service\AccountService;
use App\Service\PassengerService;
use App\Traits\JsonTrait;
use App\Validation\RequestValidation;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController
{
    use JsonTrait;

    private AccountService $accountService;
    private AddAccountRequest $addAccountRequest;
    private RequestValidation $requestValidation;
    private PassengerRepository $passengerRepository;
    private PassengerService $passengerService;
    private AddPassengerRequest $addPassengerRequest;

    /**
     * @param AccountService $accountService
     * @param AddAccountRequest $addAccountRequest
     * @param RequestValidation $requestValidation
     * @param PassengerRepository $passengerRepository
     * @param PassengerService $passengerService
     */
    public function __construct(
        AccountService      $accountService,
        AddAccountRequest   $addAccountRequest,
        RequestValidation   $requestValidation,
        PassengerRepository $passengerRepository,
        PassengerService    $passengerService,
        AddPassengerRequest $addPassengerRequest
    )
    {
        $this->accountService = $accountService;
        $this->addAccountRequest = $addAccountRequest;
        $this->requestValidation = $requestValidation;
        $this->passengerRepository = $passengerRepository;
        $this->passengerService = $passengerService;
        $this->addPassengerRequest = $addPassengerRequest;
    }


    /**
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    #[Route('/api/register', name: 'app_register', methods: 'POST')]
    public function register(Request $request): Response
    {
        $requestBody = json_decode($request->getContent(), true);
        if (!empty($this->accountService->findByEmail($requestBody['user']['email']))) {
            throw new Exception(ErrorsConstant::EMAIL_ALREADY_IN_USED);
        }
        $accountRequest = $this->validateAccount($requestBody['user']);
        $passengerRequest =$this->validatePassenger($requestBody['passenger']);
        $this->addAccountAndPassenger($accountRequest, $passengerRequest);

        return $this->success([]);
    }

    /**
     * @param $accountRequest
     * @param $passengerRequest
     * @return void
     * @throws Exception
     */
    private function addAccountAndPassenger($accountRequest, $passengerRequest): void
    {
        $account = $this->accountService->add($accountRequest);
        $this->passengerService->add($passengerRequest, $account);
    }

    /**
     * @param array $Request
     * @return AddAccountRequest
     * @throws Exception
     */
    private function validateAccount(array $Request): AddAccountRequest
    {
        $accountRequest = $this->addAccountRequest->fromArray($Request);
        $this->requestValidation->validate($accountRequest);

        return $accountRequest;
    }

    /**
     * @param array $Request
     * @return AddPassengerRequest
     * @throws Exception
     */
    private function validatePassenger(array $Request): AddPassengerRequest
    {
        $passengerRequest = $this->addPassengerRequest->fromArray($Request);
        $this->requestValidation->validate($passengerRequest);

        return $passengerRequest;
    }


}
