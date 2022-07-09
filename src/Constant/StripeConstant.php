<?php

namespace App\Constant;

class StripeConstant
{
    public const PAYMENT_SUCCESS_TOPIC = "Your payment is successfully for ";
    public const PAYMENT_SUCCESS_BODY = "Your payment was $";

    public const CANCEL_TOPIC = "Cancel successfully for ";
    public const CANCEL_BODY = "You have been refunded with $";
    public const CANCEL_COMPLETE_MESSAGE = "Cancel completed";


}
