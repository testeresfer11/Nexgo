<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class OrangeMoneyService
{
    protected $clientId;
    protected $clientSecret;
    protected $merchantKey;

    public function __construct()
    {
        $this->clientId = config('services.orange.client_id');
        $this->clientSecret = config('services.orange.client_secret');
        $this->merchantKey = config('services.orange.merchant_key');
    }

    public function getAccessToken()
    {
        $response = Http::asForm()->withBasicAuth($this->clientId, $this->clientSecret)
            ->post('https://api.orange.com/oauth/v3/token', [
                'grant_type' => 'client_credentials',
            ]);

        if ($response->successful()) {
            return $response['access_token'];
        }

        throw new \Exception("Failed to get Orange Money token: " . $response->body());
    }

    public function initiatePayment($amount, $orderId)
    {
        $token = $this->getAccessToken();

        $response = Http::withToken($token)
            ->post('https://api.orange.com/orange-money-webpay/dev/v1/webpayment', [
                'merchant_key' => $this->merchantKey,
                'currency' => 'XOF',
                'order_id' => $orderId,
                'amount' => $amount,
                'return_url' => route('orange.callback'),
                'cancel_url' => route('orange.cancel'),
                'notif_url' => route('orange.webhook'),
                'lang' => 'fr',
                'reference' => 'REF-' . Str::random(8),
            ]);

        if ($response->successful()) {
            return $response->json(); // will include "payment_url"
        }

        throw new \Exception("Payment initiation failed: " . $response->body());
    }
}
