<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthenticationSuccessListener
{
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event): void
    {
        $account = $event->getUser();
        if ($account->getPassenger() == null){
           throw new \Exception('This account has not register passenger information');
        }
        if ($account->getPassenger()->getId())
        $data['user'] = [
            'id' => $account->getPassenger()->getId(),
            'username' => $account->getUserIdentifier(),
            'roles' => $account->getRoles(),
        ];
        $data = array_merge($data, $event->getData());

        $event->setData($data);
    }
}
