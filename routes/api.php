<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

require __DIR__.'\Supplier\supplier.php';
require __DIR__.'\Product\product.php';
require __DIR__.'\Brand\brand.php';
