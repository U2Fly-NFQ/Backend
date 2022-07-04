<?php

namespace App\Controller\Register;

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
    public function __construct(AccountService $accountService,
                                AddAccountRequest $addAccountRequest,
                                RequestValidation $requestValidation,
                                PassengerRepository $passengerRepository,
                                PassengerService $passengerService,
                                AddPassengerRequest $addPassengerRequest)
    {
        $this->accountService = $accountService;
        $this->addAccountRequest = $addAccountRequest;
        $this->requestValidation = $requestValidation;
        $this->passengerRepository = $passengerRepository;
        $this->passengerService = $passengerService;
        $this->addPassengerRequest = $addPassengerRequest;
    }


    #[Route('/api/register', name: 'app_register', methods: 'POST')]
    public function register(Request $request): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);
        $accountRequest = $requestBody['user'];
        $account = $this->createAccount($accountRequest);

        $passengerRequest = $requestBody['passenger'];
        $passenger = $this->createPassenger($passengerRequest, $account);

        $this->success([]);
    }

    private function createAccount(array $Request): Account
    {
        $accountRequest = $this->addAccountRequest->fromArray($Request);
        $this->requestValidation->validate($accountRequest);
        $account = $this->accountService->add($accountRequest);

        return $account;
    }

    private function createPassenger(array $Request, Account $account): AbstractEntity
    {
        $passengerRequest = $this->addPassengerRequest->fromArray($Request);
        $this->requestValidation->validate($passengerRequest);
        $passenger = $this->passengerService->add($passengerRequest, $account);

        return $passenger;
    }
}
