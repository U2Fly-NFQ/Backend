<?php

namespace App\Service;

use App\Constant\StripeConstant;
use App\Entity\Ticket;
use App\Transformer\TicketTransformer;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class MailService
{

    const SUPPORT_MAIL_NAME = 'U2Fly Support';
    private ContainerBagInterface $containerBag;
    private TicketTransformer $ticketTransformer;

    public function __construct(
        ContainerBagInterface $containerBag,
        TicketTransformer     $ticketTransformer
    )
    {
        $this->containerBag = $containerBag;
        $this->ticketTransformer = $ticketTransformer;
    }

    public function mail($ticketArray, $mailBody, $topic): void
    {
        $mail = new PHPMailer(true);
//        dd($ticketArray);
        try {
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host = $this->containerBag->get('zohoHost');
            $mail->SMTPAuth = true;
            $mail->Username = $this->containerBag->get('zohoMail');
            $mail->Password = $this->containerBag->get('zohoPassword');
            $mail->SMTPSecure = PHPMAILER::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($this->containerBag->get('zohoMail'), self::SUPPORT_MAIL_NAME);
            $mail->addAddress($ticketArray['email'], $ticketArray['passenger']['name']);
            $mail->isHTML(false);
            $mail->Subject = $topic . $ticketArray['passenger']['name'];
            $mail->Body = $mailBody;

            $mail->send();
        } catch (Exception $e) {
            throw new \Exception("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }

    public function sendSuccess(Ticket $ticket, string $filepath)
    {
        $now = new \DateTime();
        $bookDate = $now->format('Y-m-d');
        $ticketArray = $this->ticketTransformer->toArray($ticket);
        $mailBody = file_get_contents($filepath);
        $mailBody = str_replace('%now%', $bookDate, $mailBody);
        $mailBody = str_replace('%user%', $ticketArray['passenger']['name'], $mailBody);
        $mailBody = str_replace('%paymentId%', $ticketArray['paymentId'], $mailBody);
        $mailBody = str_replace('%totalPrice%', $ticketArray['totalPrice'], $mailBody);
        $topic  = StripeConstant::PAYMENT_SUCCESS_TOPIC;

        $this->mail($ticketArray, $mailBody, $topic);

    }

    public function sendRefund(Ticket $ticket, string $filepath)
    {
        $now = new \DateTime();
        $refundDate = $now->format('Y-m-d');
        $mailBody = file_get_contents($filepath);
        $mailBody = str_replace('%now%', $refundDate, $mailBody);
        $mailBody = str_replace('%user%', $ticket['name'], $mailBody);
        $mailBody = str_replace('%paymentId%', $ticket['paymentId'], $mailBody);
        $topic  = StripeConstant::CANCEL_TOPIC;

        $this->mail($ticket, $mailBody, $topic);
    }

}
