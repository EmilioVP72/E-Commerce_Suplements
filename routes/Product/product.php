<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes Product
|--------------------------------------------------------------------------
|*/
Route::prefix('products')->group(function () {
    Route::get('/all', [ProductController::class, 'index']);
    Route::get('/OneSupplier/{id}', [SupplierController::class, 'show']);
    Route::post('/StoreSupplier', [SupplierController::class, 'store']);
    Route::put('/UpdateSupplier/{id}', [SupplierController::class, 'update']);
});
