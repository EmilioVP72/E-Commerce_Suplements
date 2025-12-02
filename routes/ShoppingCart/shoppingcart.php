<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoppingCart\ShoppingCartController;

/*
|--------------------------------------------------------------------------
| API Routes ShoppingCart
|--------------------------------------------------------------------------
|*/

Route::post('/cart/finalize', [ShoppingCartController::class, 'finalizePurchase'])->name('cart.finalize');
Route::get('/payment/success', [ShoppingCartController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/pending', [ShoppingCartController::class, 'paymentPending'])->name('payment.pending');
Route::get('/payment/failure', [ShoppingCartController::class, 'paymentFailure'])->name('payment.failure');
Route::post('/payment/notification', [ShoppingCartController::class, 'paymentNotification'])->name('payment.notification');
