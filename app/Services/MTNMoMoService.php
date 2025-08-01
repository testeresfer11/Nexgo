<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class MTNMoMoService
{
    protected $primaryKey;
    protected $apiUser;
    protected $apiSecret;
    protected $targetEnv;

    public function __construct()
    {
        $this->primaryKey = config('services.mtn.primary_key');
        $this->apiUser = config('services.mtn.api_user');
        $this->apiSecret = config('services.mtn.api_secret');
        $this->targetEnv = config('services.mtn.target_env', 'sandbox');
    }

    public function getAccessToken()
    {
        $response = Http::withHeaders([
            'Ocp-Apim-Subscription-Key' => $this->primaryKey,
        ])->withBasicAuth($this->apiUser, $this->apiSecret)
          ->post('https://sandbox.momodeveloper.mtn.com/collection/token/');

        if ($response->successful()) {
            return $response['access_token'];
        }

        throw new \Exception('Unable to get access token: ' . $response->body());
    }

    public function requestToPay($amount, $phoneNumber)
    {
        $uuid = (string) Str::uuid();
        $accessToken = $this->getAccessToken();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'X-Reference-Id' => $uuid,
            'X-Target-Environment' => $this->targetEnv,
            'Ocp-Apim-Subscription-Key' => $this->primaryKey,
            'Content-Type' => 'application/json',
        ])->post('https://sandbox.momodeveloper.mtn.com/collection/v1_0/requesttopay', [
            'amount' => $amount,
            'currency' => 'EUR', // Use XAF, UGX, or local currency if required
            'externalId' => 'TX-' . time(),
            'payer' => [
                'partyIdType' => 'MSISDN',
                'partyId' => $phoneNumber,
            ],
            'payerMessage' => 'Payment for order',
            'payeeNote' => 'Thanks',
        ]);

        if ($response->successful()) {
            return [
                'transaction_id' => $uuid,
                'status' => 'initiated',
            ];
        }

        throw new \Exception('Request to pay failed: ' . $response->body());
    }

    public function getTransactionStatus($uuid)
    {
        $accessToken = $this->getAccessToken();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'X-Target-Environment' => $this->targetEnv,
            'Ocp-Apim-Subscription-Key' => $this->primaryKey,
        ])->get("https://sandbox.momodeveloper.mtn.com/collection/v1_0/requesttopay/{$uuid}");

        if ($response->successful()) {
            return $response->json(); // status: PENDING, SUCCESSFUL, FAILED
        }

        throw new \Exception('Failed to fetch transaction status: ' . $response->body());
    }
}
