<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Rol\RolController;

/*
|--------------------------------------------------------------------------
| API Routes Rol
|--------------------------------------------------------------------------
|*/

Route::get('/all', [RolController::class, 'index']);
Route::get('/OneRol/{id}', [RolController::class, 'oneRol']);
Route::post('/StoreRol', [RolController::class, 'storeRol']);
Route::post('/UpdateRol/{id}', [RolController::class, 'updateRol']);
Route::delete('/DeleteRol/{id}', [RolController::class, 'deleteRol']);

