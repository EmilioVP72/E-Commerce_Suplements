<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Privilege\PrivilegeController;

/*
|--------------------------------------------------------------------------
| API Routes Privilege
|--------------------------------------------------------------------------
|*/
Route::prefix('privileges')->group(function () {
    Route::get('/all', [PrivilegeController::class, 'index']);
    Route::get('/OnePrivilege/{id}', [PrivilegeController::class, 'show']);
    Route::post('/StorePrivilege', [PrivilegeController::class, 'store']);
    Route::put('/UpdatePrivilege/{id}', [PrivilegeController::class, 'update']);
    Route::delete('/DeletePrivilege/{id}', [PrivilegeController::class, 'destroy']);
});
