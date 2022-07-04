<?php

namespace App\Service;

use App\Entity\Account;
use App\Mapper\AddAccountRequestMapper;
use App\Repository\AccountRepository;
use App\Request\AccountRequest\PatchAccountRequest;
use App\Request\AddAccountRequest;
use App\Transformer\AccountTransformer;

class AccountService
{
    private AccountRepository $accountRepository;
    private AccountTransformer $accountTransformer;
    private AddAccountRequestMapper $addAccountRequestMapper;

    /**
     * @param AccountRepository $accountRepository
     * @param AccountTransformer $accountTransformer
     */
    public function __construct(AccountRepository $accountRepository, AccountTransformer $accountTransformer, AddAccountRequestMapper $addAccountRequestMapper)
    {
        $this->accountRepository = $accountRepository;
        $this->accountTransformer = $accountTransformer;
        $this->addAccountRequestMapper = $addAccountRequestMapper;
    }

    public function listAll(): array
    {
        $accounts = $this->accountRepository->findAll();

        return $this->accountTransformer->toArrayList($accounts);
    }

    public function add(AddAccountRequest $addAccountRequest): bool
    {
        $account = $this->addAccountRequestMapper->mapper($addAccountRequest);
        $this->accountRepository->add($account, true);

        return true;
    }

    public function patch(PatchAccountRequest $patchAccountRequest, Account $account): bool
    {
        dd($patchAccountRequest);
    }
}
