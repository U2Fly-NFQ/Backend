<?php

namespace App\Constant;

class StripeConstant
{
    public const SUCCESS_URL = 'http://3.0.57.246/api/payment/stripe/success?session_id={CHECKOUT_SESSION_ID}';
    public const TARGET_URL = 'http://localhost:3000/flights-booking';
    public const FAILED_URL = 'https://ngonaz.com/wp-content/uploads/2022/03/ve-con-heo-7.jpg';
}
