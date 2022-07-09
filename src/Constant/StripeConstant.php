<?php

namespace App\Constant;

class StripeConstant
{
    public const SUCCESS_URL = 'https://u2fly.tolehoai.me/api/stripe/success?session_id={CHECKOUT_SESSION_ID}';
    public const SUCCESS_URL_LOCAL = 'http://127.0.0.1:8000/api/stripe/success?session_id={CHECKOUT_SESSION_ID}';
    public const TARGET_URL = 'https://u2fly.org/flights-booking';
    public const FAILED_URL = 'https://ngonaz.com/wp-content/uploads/2022/03/ve-con-heo-7.jpg';

    public const PAYMENT_SUCCESS_TOPIC = "Your payment is successfully for ";
    public const PAYMENT_SUCCESS_BODY = "Your payment was $";

    public const CANCEL_TOPIC = "Cancel successfully for ";
    public const CANCEL_BODY = "You have been refunded with $";
    public const CANCEL_COMPLETE_MESSAGE = "Cancel completed";


}
