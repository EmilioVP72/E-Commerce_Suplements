<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentMethod\PaymentMethodController;

/*
|--------------------------------------------------------------------------
| API Routes Payment Method
|--------------------------------------------------------------------------
|*/

Route::get('/all', [PaymentMethodController::class, 'index']);
Route::get('/OnePaymentMethod/{id}', [PaymentMethodController::class, 'show']);
Route::post('/StorePaymentMethod', [PaymentMethodController::class, 'store']);
Route::put('/UpdatePaymentMethod/{id}', [PaymentMethodController::class, 'update']);
Route::delete('/DeletePaymentMethod/{id}', [PaymentMethodController::class, 'destroy']);
