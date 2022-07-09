<?php

namespace App\Tests\Mapper;

use App\Entity\Account;
use App\Entity\Image;
use App\Mapper\AccountRequestMapper;
use App\Repository\ImageRepository;
use App\Request\AccountRequest\PatchAccountRequest;
use App\Request\AddAccountRequest;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountRequestMapperTest extends TestCase
{
    /**
     * @return void
     */
    public function testMapper()
    {
        $addAccountRequest = $this->getMockBuilder(AddAccountRequest::class)->disableOriginalConstructor()->getMock();
        $addAccountRequest->expects($this->any())->method('getImageId')->willReturn(1);
        $accountRequestMapper = $this->createAccountRequestMapper();
        $result = $accountRequestMapper->mapper($addAccountRequest);

        $this->assertInstanceOf(Account::class, $result);
    }

    /**
     * @return void
     */
    public function testPatchMapper()
    {
        $patchAccountRequest = $this->getMockBuilder(PatchAccountRequest::class)->disableOriginalConstructor()->getMock();
        $patchAccountRequest->expects($this->any())->method('getPassword')->willReturn('123');
        $account = $this->getMockBuilder(Account::class)->disableOriginalConstructor()->getMock();
        $accountRequestMapper = $this->createAccountRequestMapper();
        $result = $accountRequestMapper->patchMapper($patchAccountRequest, $account);

        $this->assertInstanceOf(Account::class, $result);
    }

    /**
     * @return AccountRequestMapper
     */
    public function createAccountRequestMapper(): AccountRequestMapper
    {
        $image = $this->getMockBuilder(Image::class)->disableOriginalConstructor()->getMock();
        $imageRepository = $this->getMockBuilder(ImageRepository::class)->disableOriginalConstructor()->getMock();
        $imageRepository->expects($this->any())->method('find')->willReturn($image);
        $passwordHarsher = $this->getMockBuilder(UserPasswordHasherInterface::class)->disableOriginalConstructor()->getMock();

        return new AccountRequestMapper($imageRepository,$passwordHarsher);
    }
}
