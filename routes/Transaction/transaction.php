<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Transaction\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes Transaction
|--------------------------------------------------------------------------
|*/

Route::get('/all', [TransactionController::class, 'index']);
Route::get('/OneTransaction/{id}', [TransactionController::class, 'show']);
Route::post('/StoreTransaction', [TransactionController::class, 'store']);
Route::put('/UpdateTransaction/{id}', [TransactionController::class, 'update']);
Route::delete('/DeleteTransaction/{id}', [TransactionController::class, 'destroy']);
