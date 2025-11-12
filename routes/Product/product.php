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
    Route::get('/OneProduct/{id}', [ProductController::class, 'show']);
    Route::post('/StoreProduct', [ProductController::class, 'store']);
    Route::put('/UpdateProduct/{id}', [ProductController::class, 'update']);
    Route::delete('/DeleteProduct/{id}', [ProductController::class, 'destroy']);
});
