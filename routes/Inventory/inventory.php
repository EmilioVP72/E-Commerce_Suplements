<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inventory\InventoryController;

/*
|--------------------------------------------------------------------------
| API Routes Inventory
|--------------------------------------------------------------------------
|*/
Route::prefix('inventories')->group(function () {
    Route::get('/all', [InventoryController::class, 'index']);
    Route::get('/OneInventory/{id}', [InventoryController::class, 'show']);
    Route::post('/StoreInventory', [InventoryController::class, 'store']);
    Route::put('/UpdateInventory/{id}', [InventoryController::class, 'update']);
    Route::delete('/DeleteInventory/{id}', [InventoryController::class, 'destroy']);
});
