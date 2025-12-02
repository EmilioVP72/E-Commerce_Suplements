<?php

namespace App\Services;

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
        MercadoPagoConfig::setAccessToken(config('mercadopago.access_token'));
        MercadoPagoConfig::setRuntimeEnviroment(config('mercadopago.environment', 'sandbox'));
        
        $this->preferenceClient = new PreferenceClient();
        $this->paymentClient = new PaymentClient();
    }

    public function createPreference(array $items, $userId = null)
    {
        try {
            $body = [
                "items" => $this->formatItems($items),
                "payer" => [
                    "email" => auth()->user()->email ?? "test@test.com"
                ],
                "back_urls" => [
                    "success" => route('payment.success'),
                    "pending" => route('payment.pending'),
                    "failure" => route('payment.failure')
                ],
                "auto_return" => "approved",
                "notification_url" => route('payment.notification'),
                "external_reference" => "USER-{$userId}-" . time(),
            ];

            $preference = $this->preferenceClient->create($body);
            return $preference;
        } catch (MPApiException $e) {
            Log::error('MercadoPago Error creating preference: ' . $e->getMessage());
            throw new \Exception('Error creating payment preference: ' . $e->getMessage());
        }
    }

    public function getPayment($paymentId)
    {
        try {
            $payment = $this->paymentClient->get($paymentId);
            return $payment;
        } catch (MPApiException $e) {
            Log::error('MercadoPago Error getting payment: ' . $e->getMessage());
            throw new \Exception('Error retrieving payment: ' . $e->getMessage());
        }
    }

    private function formatItems(array $cartItems): array
    {
        return array_map(function ($item) {
            return [
                "title" => $item['product']['product'] ?? 'Producto',
                "quantity" => $item['quantity'],
                "unit_price" => (float) $item['product']['sale_price'],
            ];
        }, $cartItems);
    }

    public function calculateTotal(array $cartItems): float
    {
        return array_reduce($cartItems, function ($total, $item) {
            return $total + ($item['quantity'] * $item['product']['sale_price']);
        }, 0);
    }
}