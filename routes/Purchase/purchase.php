<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Purchase\PurchaseController;

/*
|--------------------------------------------------------------------------
| API Routes Purchase
|--------------------------------------------------------------------------
|*/

Route::get('/all', [PurchaseController::class, 'index']);
Route::get('/OnePurchase/{id}', [PurchaseController::class, 'show']);
Route::post('/StorePurchase', [PurchaseController::class, 'store']);
Route::put('/UpdatePurchase/{id}', [PurchaseController::class, 'update']);
Route::delete('/DeletePurchase/{id}', [PurchaseController::class, 'destroy']);
