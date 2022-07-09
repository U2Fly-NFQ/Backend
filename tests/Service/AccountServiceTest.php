<?php

namespace App\Tests\Service;

use App\Entity\Account;
use App\Mapper\AccountRequestMapper;
use App\Repository\AccountRepository;
use App\Request\AccountRequest\PatchAccountRequest;
use App\Request\AddAccountRequest;
use App\Service\AccountService;
use App\Transformer\AccountTransformer;
use PHPUnit\Framework\TestCase;

class AccountServiceTest extends TestCase
{
    public function testListAll()
    {
        $accountService = $this->createAccountService();

        $result = $accountService->listAll();

        $this->assertIsArray($result);
    }

    public function testAdd()
    {
        $accountService = $this->createAccountService();
        $addAccountRequest = $this->getMockBuilder(AddAccountRequest::class)->disableOriginalConstructor()->getMock();
        $result = $accountService->add($addAccountRequest);

        $this->assertInstanceOf(Account::class, $result);
    }

    public function testPatch()
    {
        $accountService = $this->createAccountService();
        $accountRequest = $this->getMockBuilder(PatchAccountRequest::class)->disableOriginalConstructor()->getMock();
        $account = $this->getMockBuilder(Account::class)->disableOriginalConstructor()->getMock();
        $result = $accountService->patch($accountRequest, $account);

        $this->assertTrue($result);
    }

    public function testFindByEmail()
    {
        $accountService = $this->createAccountService();
        $result = $accountService->findByEmail(['email'=>'sang@gmail.com']);

        $this->assertIsArray($result);
    }

    public function createAccountService()
    {
        $account = $this->getMockBuilder(Account::class)->disableOriginalConstructor()->getMock();
        $accountRepository = $this->getMockBuilder(AccountRepository::class)->disableOriginalConstructor()->getMock();
        $accountTransformer = $this->getMockBuilder(AccountTransformer::class)->disableOriginalConstructor()->getMock();
        $accountRequestMapper = $this->getMockBuilder(AccountRequestMapper::class)->disableOriginalConstructor()->getMock();
        $accountRepository->expects($this->any())->method('findAll')->willReturn([$account]);
        $accountRepository->expects($this->any())->method('findBy')->willReturn([$account]);


        return new AccountService($accountRepository, $accountTransformer, $accountRequestMapper);
    }
}
