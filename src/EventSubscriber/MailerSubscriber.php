<?php

namespace App\EventSubscriber;

use App\Constant\StripeConstant;
use App\Event\MailerEvent;
use App\Service\MailService;
use App\Service\PassengerService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class MailerSubscriber implements EventSubscriberInterface
{
    private PassengerService $passengerService;
    private MailService $mailService;

    public function __construct(
        PassengerService $passengerService,
        MailService      $mailService
    )
    {
        $this->passengerService = $passengerService;
        $this->mailService = $mailService;
    }

    public static function getSubscribedEvents()
    {
        return [
            'event.successMail' => 'successMail',
            'event.refundMail' => 'refundMail',
        ];
    }

    public function successMail(MailerEvent $mailerEvent)
    {
        $ticket = $mailerEvent->getTicket();
        $passenger = $this->passengerService->find($ticket->getPassenger());
        $accountEmail = $passenger->getAccount()->getEmail();
        $passengerName = $passenger->getName();

        $contain = [
            'topic' => StripeConstant::PAYMENT_SUCCESS_TOPIC,
            'body' => StripeConstant::PAYMENT_SUCCESS_BODY,
            'totalPrice' => $ticket->getTotalPrice()
        ];
        $this->mailService->mail($accountEmail, $passengerName, $contain);
    }

    public function refundMail(MailerEvent $mailerEvent)
    {
        $ticket = $mailerEvent->getTicket();
        $passenger = $this->passengerService->find($ticket->getPassenger());
        $accountEmail = $passenger->getAccount()->getEmail();
        $passengerName = $passenger->getName();
        $contain = [
            'topic' => StripeConstant::CANCEL_TOPIC,
            'body' => StripeConstant::CANCEL_BODY,
            'totalPrice' => $ticket->getTotalPrice()
        ];

        $this->mailService->mail($accountEmail, $passengerName, $contain);
    }
}
