<?php

namespace App\Constant;

class StripeConstant
{
    public const SUCCESS_URL = 'http://127.0.0.1:8000/api/payment/stripe/success?session_id={CHECKOUT_SESSION_ID}';
    public const FAILED_URL = 'https://ngonaz.com/wp-content/uploads/2022/03/ve-con-heo-7.jpg';
}
