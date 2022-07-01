<?php

namespace App\Request;
use Exception;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\ItemList;

class PayPalRequest
{
    public function set($apiContext)
    {
        if (empty($_POST['item_number'])) {
            throw new Exception('This script should not be called directly, expected post data');
        }

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
// Set some example data for the payment.
        $currency = 'USD';
        $item_qty = 1;
        $amountPayable = $_POST['amount'];
        $product_name = $_POST['item_name'];
        $item_code = $_POST['item_number'];
        $description = 'Paypal transaction';
        $invoiceNumber = uniqid();
        $my_items = array(
            array('name'=> $product_name, 'quantity'=> $item_qty, 'price'=> $amountPayable, 'sku'=> $item_code, 'currency'=> $currency)
        );

        $amount = new Amount();
        $amount->setCurrency($currency)
            ->setTotal($amountPayable);

        $items = new ItemList();
        $items->setItems($my_items);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription($description)
            ->setInvoiceNumber($invoiceNumber)
            ->setItemList($items);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl('https://www.google.com/')
            ->setCancelUrl('https://www.google.com/doodles');

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($apiContext);
        } catch (Exception $e) {
            throw new Exception('Unable to create link for payment');
        }

        header('location:' . $payment->getApprovalLink());
        exit(1);
    }
}
