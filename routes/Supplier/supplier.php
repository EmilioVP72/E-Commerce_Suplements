<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Supplier\SupplierController;

/*
|--------------------------------------------------------------------------
| API Routes Supplier
|--------------------------------------------------------------------------
|*/

Route::get('/all', [SupplierController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/OneSupplier/{id}', [SupplierController::class, 'show']);
Route::post('/StoreSupplier', [SupplierController::class, 'store']);
Route::put('/UpdateSupplier/{id}', [SupplierController::class, 'update']);
Route::delete('/DeleteSupplier/{id}', [SupplierController::class,'destroy']);

