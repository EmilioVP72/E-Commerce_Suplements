<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/all', [UserController::class, 'index']);
Route::post('/StoreUser', [UserController::class, 'storeUser']);
Route::get('/OneUser/{id}', [UserController::class, 'oneUser']);
Route::put('/UpdateUser/{id}', [UserController::class, 'updateUser']);
Route::delete('/DeleteUser/{id}', [UserController::class, 'deleteUser']);
