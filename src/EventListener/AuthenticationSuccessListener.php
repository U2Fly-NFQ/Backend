<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthenticationSuccessListener
{
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event): void
    {
        $data = $event->getData();
        $account = $event->getUser();
        if (!$account instanceof UserInterface) {
            return;
        }
        $data['data'] = [
            'id'=>$account->getId(),
            'username'=>$account->getUserIdentifier(),
            'roles' => $account->getRoles()
        ];
        $event->setData($data);
    }
}
