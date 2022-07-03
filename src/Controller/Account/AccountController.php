<?php

namespace App\Controller\Account;

use App\Repository\AccountRepository;
use App\Service\AccountService;
use App\Traits\JsonTrait;
use App\Transformer\AccountTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    use JsonTrait;

    #[Route('/api/account/{id}', name: 'app_find_account', methods: 'GET')]
    public function findById(int $id, AccountRepository $accountRepository , AccountTransformer $accountTransformer): JsonResponse
    {
        $account = $accountRepository->find($id);
        if($account == null){
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
}
