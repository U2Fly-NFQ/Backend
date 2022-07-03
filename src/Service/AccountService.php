<?php

namespace App\Service;

use App\Repository\AccountRepository;
use App\Transformer\AccountTransformer;

class AccountService
{
    private AccountRepository $accountRepository;
    private AccountTransformer $accountTransformer;

    /**
     * @param AccountRepository $accountRepository
     * @param AccountTransformer $accountTransformer
     */
    public function __construct(AccountRepository $accountRepository, AccountTransformer $accountTransformer)
    {
        $this->accountRepository = $accountRepository;
        $this->accountTransformer = $accountTransformer;
    }

    public function listAll(): array
    {
        $accounts = $this->accountRepository->findAll();

        return $this->accountTransformer->toArrayList($accounts);
    }
}
