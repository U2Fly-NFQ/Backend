<?php

namespace App\Service;

use App\Entity\Account;

use App\Mapper\AccountRequestMapper;
use App\Repository\AccountRepository;
use App\Request\AccountRequest\PatchAccountRequest;
use App\Request\AddAccountRequest;
use App\Transformer\AccountTransformer;

class AccountService
{
    private AccountRepository $accountRepository;
    private AccountTransformer $accountTransformer;
    private AccountRequestMapper $accountRequestMapper;

    /**
     * @param AccountRepository $accountRepository
     * @param AccountTransformer $accountTransformer
     */
    public function __construct(AccountRepository $accountRepository, AccountTransformer $accountTransformer, AccountRequestMapper $accountRequestMapper)
    {
        $this->accountRepository = $accountRepository;
        $this->accountTransformer = $accountTransformer;
        $this->accountRequestMapper = $accountRequestMapper;
    }

    public function listAll(): array
    {
        $accounts = $this->accountRepository->findAll();

        return $this->accountTransformer->toArrayList($accounts);
    }

    public function add(AddAccountRequest $addAccountRequest): Account
    {
        $account = $this->accountRequestMapper->mapper($addAccountRequest);

        return $this->accountRepository->add($account, true);
    }

    public function patch(PatchAccountRequest $patchAccountRequest, Account $account): bool
    {
        $patchAccount = $this->accountRequestMapper->patchMapper($patchAccountRequest, $account);
        $this->accountRepository->add($patchAccount, true);

        return true;
    }
}
