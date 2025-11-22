<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseDetail\PurchaseDetailController;

/*
|--------------------------------------------------------------------------
| API Routes Purchase Detail
|--------------------------------------------------------------------------
|*/

Route::get('/all', [PurchaseDetailController::class, 'index']);
Route::get('/OnePurchaseDetail/{id}', [PurchaseDetailController::class, 'show']);
Route::post('/StorePurchaseDetail', [PurchaseDetailController::class, 'store']);
Route::put('/UpdatePurchaseDetail/{id}', [PurchaseDetailController::class, 'update']);
Route::delete('/DeletePurchaseDetail/{id}', [PurchaseDetailController::class, 'destroy']);
