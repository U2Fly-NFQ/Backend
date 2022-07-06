<?php

namespace App\Constant;

class StripeConstant
{
    public const SUCCESS_URL = 'https://u2fly.tolehoai.me/api/payment/stripe/success?session_id={CHECKOUT_SESSION_ID}';
    public const SUCCESS_URL_LOCAL = 'http://127.0.0.1:8000/api/payment/stripe/success?session_id={CHECKOUT_SESSION_ID}';
    public const TARGET_URL = 'http://localhost:3000/flights-booking';
    public const FAILED_URL = 'https://ngonaz.com/wp-content/uploads/2022/03/ve-con-heo-7.jpg';
}
