<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MomoApiService
{
    protected $baseUrl;
    protected $primaryKey;
    protected $apiUser;
    protected $apiKey;
    protected $targetEnvironment;
    protected $callbackUrl;

    public function __construct()
    {
        $this->primaryKey = env('MOMO_PRIMARY_KEY');
        $this->apiUser = env('MOMO_API_USER');
        $this->apiKey = env('MOMO_API_KEY');
        $this->targetEnvironment = env('MOMO_TARGET_ENVIRONMENT', 'sandbox');
        
        $this->baseUrl = $this->targetEnvironment === 'sandbox' 
            ? 'https://sandbox.momodeveloper.mtn.com'
            : 'https://proxy.momoapi.mtn.com';

        $this->callbackUrl = env('APP_URL') . '/api/webhooks/momo';
    }

    /**
     * Generate an access token from the MTN MoMo API.
     */
    public function getAccessToken()
    {
        if (empty($this->primaryKey) || empty($this->apiUser) || empty($this->apiKey)) {
            Log::warning('MoMo API credentials are missing. Running in simulator mode.');
            return 'fake-sandbox-access-token';
        }

        try {
            $response = Http::withHeaders([
                'Ocp-Apim-Subscription-Key' => $this->primaryKey,
            ])
            ->withBasicAuth($this->apiUser, $this->apiKey)
            ->post("{$this->baseUrl}/collection/token/");

            if ($response->successful()) {
                return $response->json('access_token');
            }

            Log::error('MTN MoMo Token request failed: ' . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error('MTN MoMo Token request error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Request a payment from a subscriber (Collection / requesttopay)
     */
    public function requestToPay(string $referenceId, float $amount, string $phoneNumber, string $orderId)
    {
        $normalizedPhone = $phoneNumber;
        if (str_starts_with($normalizedPhone, '0')) {
            $normalizedPhone = '233' . substr($normalizedPhone, 1);
        } elseif (!str_starts_with($normalizedPhone, '233') && strlen($normalizedPhone) === 9) {
            $normalizedPhone = '233' . $normalizedPhone;
        }

        if (empty($this->primaryKey) || empty($this->apiUser) || empty($this->apiKey)) {
            Log::info("Momo API mock payment initiated for Order #{$orderId} (Reference: {$referenceId}, Phone: {$normalizedPhone})");
            return [
                'success' => true,
                'status' => 'PENDING',
                'message' => 'Simulated Request-to-Pay initiated successfully.',
                'simulated' => true
            ];
        }

        $token = $this->getAccessToken();
        if (!$token) {
            return [
                'success' => false,
                'message' => 'Failed to obtain MoMo API access token.'
            ];
        }

        $currency = $this->targetEnvironment === 'sandbox' ? 'EUR' : 'GHS';

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$token}",
                'X-Reference-Id' => $referenceId,
                'X-Target-Environment' => $this->targetEnvironment,
                'Ocp-Apim-Subscription-Key' => $this->primaryKey,
                'X-Callback-Url' => $this->callbackUrl,
                'Content-Type' => 'application/json',
            ])
            ->post("{$this->baseUrl}/collection/v1_0/requesttopay", [
                'amount' => number_format($amount, 2, '.', ''),
                'currency' => $currency,
                'externalId' => $orderId,
                'payer' => [
                    'partyIdType' => 'MSISDN',
                    'partyId' => $normalizedPhone,
                ],
                'payerMessage' => "FarmLink Order #{$orderId} Escrow Payment",
                'payeeNote' => "FarmLink Escrow Holder",
            ]);

            if ($response->status() === 202 || $response->successful()) {
                return [
                    'success' => true,
                    'status' => 'PENDING',
                    'message' => 'Request-to-Pay initiated. Awaiting user authorization prompt on phone.'
                ];
            }

            Log::error('MTN Request-to-Pay API failed: ' . $response->body());
            return [
                'success' => false,
                'message' => 'Request-to-Pay initiation failed: ' . ($response->json('message') ?? $response->body())
            ];
        } catch (\Exception $e) {
            Log::error('MTN Request-to-Pay exception: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Request-to-Pay API connection error: ' . $e->getMessage()
            ];
        }
    }
}
