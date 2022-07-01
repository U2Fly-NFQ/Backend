<?php

namespace App\Service;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

class PayPalService
{
    public function config(): ApiContext
    {
        $paypalConfig = [
            'client_id' => 'sb-jottp18046533@business.example.com',
            'client_secret' => 'EIMHekUwZuZIHaOIF5aDtNlPZLeM6-5morPrOU4ULpjz5tEcy49vtL1XjBPYlGF_UmVRvP_SMQOygztm',
            'return_url' => 'https://www.google.com/',
            'cancel_url' => 'https://www.google.com/doodles'
        ];

        $dbConfig = [
            'host' => '127.0.0.1:3336',
            'username' => 'tolehoai',
            'password' => 'Tolehoai1212!@!@'
        ];

        return $this->getApiContext($paypalConfig['client_id'], $paypalConfig['client_secret'], true);
    }

    /**
     * Set up a connection to the API
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param bool $enableSandbox Sandbox mode toggle, true for test payments
     * @return ApiContext
     */
    public function getApiContext(string $clientId, string $clientSecret, bool $enableSandbox = false): ApiContext
    {
        $apiContext = new ApiContext(
            new OAuthTokenCredential($clientId, $clientSecret)
        );

        $apiContext->setConfig([
            'mode' => $enableSandbox ? 'sandbox' : 'live'
        ]);
        return $apiContext;
    }
}
