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
    const SUCCESS_MAIL = __DIR__ . '/../../public/file/SuccessMail.html';
    const REFUND_MAIL = __DIR__ . '/../../public/file/RefundMail.html';

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

        $this->mailService->sendSuccess($ticket, self::SUCCESS_MAIL);
    }

    public function refundMail(MailerEvent $mailerEvent)
    {
        $ticket = $mailerEvent->getTicket();
        $this->mailService->sendRefund($ticket, self::REFUND_MAIL);
    }
}
