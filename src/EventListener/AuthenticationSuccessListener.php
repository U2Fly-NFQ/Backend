<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthenticationSuccessListener
{
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event): void
    {
        $account = $event->getUser();
        if (!$account instanceof UserInterface) {
            return;
        }
        $data = [
            'id' => $account->getId(),
            'username' => $account->getUserIdentifier(),
            'roles' => $account->getRoles(),
        ];
        $data = array_merge($data, $event->getData());

        $event->setData($data);
    }
}
