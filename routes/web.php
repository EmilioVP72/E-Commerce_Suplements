<?php

use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = Product::latest()->take(6)->get();
    return view('welcome', ['products' => $products]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/administration', function () {
    return view('administration');
})->middleware(['auth', 'verified', 'role:Administrador'])->name('administration');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

use App\Http\Controllers\Brand\BrandPageController;

Route::resource('brands', BrandPageController::class)->middleware(['auth', 'verified']);

use App\Http\Controllers\Product\ProductPageController;

Route::resource('products', ProductPageController::class)->middleware(['auth', 'verified']);

use App\Http\Controllers\Supplier\SupplierPageController;

Route::resource('suppliers', SupplierPageController::class)->middleware(['auth', 'verified']);
