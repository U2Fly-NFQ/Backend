<?php

namespace App\Mapper;

use App\Constant\RoleConstant;
use App\Entity\Account;
use App\Repository\ImageRepository;
use App\Request\AccountRequest\PatchAccountRequest;
use App\Request\AddAccountRequest;
use DateTime;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountRequestMapper extends BaseMapper
{
    private ImageRepository $imageRepository;
    private UserPasswordHasherInterface $passwordHasher;

    /**
     * @param ImageRepository $imageRepository
     */
    public function __construct(ImageRepository $imageRepository, UserPasswordHasherInterface $passwordHasher)
    {
        $this->imageRepository = $imageRepository;
        $this->passwordHasher = $passwordHasher;
    }

    /**
     * @param AddAccountRequest $addAccountRequest
     * @return Account
     */
    public function mapper(AddAccountRequest $addAccountRequest): Account
    {
        $account = new Account();
        if ($addAccountRequest->getImageId()) {
            $image = $this->imageRepository->find($addAccountRequest->getImageId());
            if ($image) {
                $account->setImage($image);
            }
        }
        $hashPassword = $this->passwordHasher->hashPassword($account, $addAccountRequest->getPassword());
        $account->setEmail($addAccountRequest->getEmail())
            ->setPassword($hashPassword)
            ->setRoles(["1" => RoleConstant::ROLE_USER]);

        return $account;
    }

    /**
     * @param PatchAccountRequest $patchAccountRequest
     * @param Account $account
     * @return Account
     */
    public function patchMapper(PatchAccountRequest $patchAccountRequest, Account $account): Account
    {
        $this->map($account, $patchAccountRequest->getEmail(), 'email');
        $image = $this->imageRepository->find($patchAccountRequest->getImageId());
        $this->map($account, $image, 'image');
        $this->map($account, $patchAccountRequest->getRoles(), 'roles');
        $hashPassword = $this->passwordHasher->hashPassword($account, $patchAccountRequest->getPassword());
        $this->map($account, $hashPassword, 'password');
        $now = new DateTime();
        $account->setUpdatedAt($now);

        return $account;
    }
}
