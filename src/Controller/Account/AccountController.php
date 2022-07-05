<?php

namespace App\Controller\Account;

use App\Constant\ErrorsConstant;
use App\Repository\AccountRepository;
use App\Request\AccountRequest\PatchAccountRequest;
use App\Request\AddAccountRequest;
use App\Service\AccountService;
use App\Traits\JsonTrait;
use App\Transformer\AccountTransformer;
use App\Validation\RequestValidation;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    use JsonTrait;

    #[Route('/api/account/{id}', name: 'app_find_account', methods: 'GET')]
    public function findById(int $id, AccountRepository $accountRepository, AccountTransformer $accountTransformer): JsonResponse
    {
        $account = $accountRepository->find($id);
        if ($account == null) {
            return $this->error([]);
        }
        $data = $accountTransformer->toArray($account);

        return $this->success($data);
    }

    #[Route('/api/account', name: 'app_list_account', methods: 'GET')]
    public function list(AccountService $accountService)
    {
        $data = $accountService->listAll();

        return $this->success($data);
    }

    /**
     * @throws \Exception
     */
    #[Route('/api/account', name: 'app_add_account', methods: 'POST')]
    public function add(
        Request $request,
        AccountService $accountService,
        AddAccountRequest $addAccountRequest,
        RequestValidation $requestValidation
    ): Response {
        $requestBody = json_decode($request->getContent(), true);
        $accountRequest = $addAccountRequest->fromArray($requestBody);
        $requestValidation->validate($accountRequest);
        $accountService->add($addAccountRequest);

        return $this->success([]);
    }

    /**
     * @throws Exception
     */
    #[Route('/api/account/{id}', name: 'app_update_account', methods: 'PATCH')]
    public function patch(
        int $id,
        Request $request,
        AccountRepository $accountRepository,
        RequestValidation $requestValidation,
        PatchAccountRequest $patchAccountRequest,
        AccountService $accountService
    ): JsonResponse {
        $account = $accountRepository->find($id);
        if (!$account) {
            throw new Exception();
        }
        $requestBody = json_decode($request->getContent(), true);
        $accountRequest = $patchAccountRequest->fromArray($requestBody);
        $requestValidation->validate($accountRequest);
        $accountService->patch($accountRequest, $account);

        return $this->success([]);
    }

    #[Route('/api/account/{id}', name: 'app_delete_account', methods: 'DELETE')]
    public function delete(int $id, AccountRepository $accountRepository)
    {
        $account = $accountRepository->find($id);
        if (empty($account)) {
            $this->error(ErrorsConstant::ACCOUNT_NOT_FOUND);
        }
        $accountRepository->remove($account, true);

        return $this->success([]);
    }
}
