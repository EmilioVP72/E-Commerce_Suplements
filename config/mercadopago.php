<?php

return [
    'access_token' => env('MERCADOPAGO_ACCESS_TOKEN'),
    'environment' => env('MERCADOPAGO_ENVIRONMENT', 'LOCAL'),
    'public_key' => env('MERCADOPAGO_PUBLIC_KEY'),
];