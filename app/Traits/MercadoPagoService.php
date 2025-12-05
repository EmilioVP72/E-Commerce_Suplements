<?php

namespace App\Traits;

use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use Illuminate\Support\Facades\Log;

class MercadoPagoService
{
    private PreferenceClient $preferenceClient;
    private PaymentClient $paymentClient;

    public function __construct()
    {
        $accessToken = config('mercadopago.access_token');

        if (!$accessToken) {
            Log::error("[MP] ERROR: Falta MERCADOPAGO_ACCESS_TOKEN en .env");
            throw new \Exception("Falta MERCADOPAGO_ACCESS_TOKEN en el .env");
        }

        MercadoPagoConfig::setAccessToken($accessToken);

        $this->preferenceClient = new PreferenceClient();
        $this->paymentClient = new PaymentClient();
    }

    public function createPreference(array $items, $userId = null)
    {
        try {
            $body = [
                "items" => $this->formatItems($items),
                "payer" => [
                    "email" => auth()->user()->email
                ],

                "back_urls" => [
                    "success" => route('payment.success'),
                    "failure" => route('payment.failure'),
                    "pending" => route('payment.pending'),
                ],
                "external_reference" => "USER-{$userId}-" . uniqid(),
                "metadata" => [
                    "user_id" => $userId
                ]
            ];

            Log::info("[MP] Preferencia enviada:", $body);
            return $this->preferenceClient->create($body);
        } catch (MPApiException $e) {
            $apiResponse = $e->getApiResponse();
            Log::error('[MP] API EXCEPTION DEBUG', [
                'message' => $e->getMessage(),
                'content_raw' => $apiResponse?->getContent(),  
            ]);

            throw new \Exception('Error al crear preferencia: ' . $e->getMessage());
        }
    }


    private function formatItems($items)
    {
        return collect($items)->map(function ($item) {

            $product = $item['product'];

            return [
                "title" => $product['name'] ?? $product['product'] ?? "Producto",
                "quantity" => intval($item['quantity']),
                "unit_price" => floatval($product['sale_price']),
                "currency_id" => "MXN"
            ];
        })->toArray();
    }

    public function getPayment($paymentId)
    {
        try {
            return $this->paymentClient->get($paymentId);
        } catch (MPApiException $e) {
            Log::error("[MP] Error al obtener el pago: " . $e->getMessage());
            throw new \Exception("Error al obtener el pago: " . $e->getMessage());
        }
    }

    public function calculateTotal(array $cartItems): float
    {
        return array_reduce($cartItems, function ($total, $item) {
            return $total + ($item['quantity'] * $item['product']['sale_price']);
        }, 0);
    }
}
