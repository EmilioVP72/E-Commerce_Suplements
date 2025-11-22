<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionDetail\TransactionDetailController;

/*
|--------------------------------------------------------------------------
| API Routes Transaction Detail
|--------------------------------------------------------------------------
|*/

Route::get('/all', [TransactionDetailController::class, 'index']);
Route::get('/OneTransactionDetail/{id}', [TransactionDetailController::class, 'show']);
Route::post('/StoreTransactionDetail', [TransactionDetailController::class, 'store']);
Route::put('/UpdateTransactionDetail/{id}', [TransactionDetailController::class, 'update']);
Route::delete('/DeleteTransactionDetail/{id}', [TransactionDetailController::class, 'destroy']);
