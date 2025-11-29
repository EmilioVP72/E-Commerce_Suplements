<?php

use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductPageController;
use App\Http\Controllers\Brand\BrandPageController;
use App\Http\Controllers\Supplier\SupplierPageController;
use App\Http\Controllers\Catalog\CatalogPageController;
use App\Http\Controllers\Inventory\InventoryPageController;
use App\Http\Controllers\BrandCatalog\BrandCatalogPageController;
use App\Http\Controllers\PaymentMethod\PaymentMethodPageController;
use App\Http\Controllers\Purchase\PurchasePageController;
use App\Http\Controllers\PurchaseDetail\PurchaseDetailPageController;
use App\Http\Controllers\Residence\ResidencePageController;
use App\Http\Controllers\ResidenceUser\ResidenceUserPageController;
use App\Http\Controllers\Transaction\TransactionPageController;
use App\Http\Controllers\TransactionDetail\TransactionDetailPageController;
use App\Http\Controllers\ShoppingCart\ShoppingCartController;

Route::get('/', function () {
    $products = Product::latest()->take(6)->get();
    return view('welcome', ['products' => $products]);
})->name('home');

Route::get('/product/{id}', [ProductPageController::class, 'show'])->name('product.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/administration', function () {
    return view('administration');
})->middleware(['auth', 'verified', 'role:Administrador'])->name('administration');

Route::middleware('auth')->group(function () {
    Route::get('/cart', [ShoppingCartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [ShoppingCartController::class, 'add'])->name('cart.add');
    Route::put('/cart/{cartId}', [ShoppingCartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cartId}', [ShoppingCartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart', [ShoppingCartController::class, 'clear'])->name('cart.clear');
    Route::get('/cart-data', [ShoppingCartController::class, 'getCartData'])->name('cart.data');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

// CRUDS, PDFS Y REPORTES
Route::resource('brands', BrandPageController::class)->middleware(['auth', 'verified']);
// PRODUCTS
Route::get('products/print', [ProductPageController::class, 'print'])->name('products.print')->middleware(['auth', 'verified']);
Route::get('products/stats', [ProductPageController::class, 'stats'])->name('products.stats')->middleware(['auth', 'verified']);
Route::get('products/export', [ProductPageController::class, 'exportExcel'])->name('products.export')->middleware(['auth', 'verified']);
Route::resource('products', ProductPageController::class)->middleware(['auth', 'verified']);
Route::resource('suppliers', SupplierPageController::class)->middleware(['auth', 'verified']);
Route::resource('catalogs', CatalogPageController::class)->middleware(['auth', 'verified']);
Route::resource('inventories', InventoryPageController::class)->middleware(['auth', 'verified']);
Route::resource('brand_catalogs', BrandCatalogPageController::class)->middleware(['auth', 'verified']);
Route::resource('payment_methods', PaymentMethodPageController::class)->middleware(['auth', 'verified']);
Route::resource('purchases', PurchasePageController::class)->middleware(['auth', 'verified']);
Route::resource('purchase_details', PurchaseDetailPageController::class)->middleware(['auth', 'verified']);
Route::resource('transactions', TransactionPageController::class)->middleware(['auth', 'verified']);
Route::resource('transaction_details', TransactionDetailPageController::class)->middleware(['auth', 'verified']);
Route::resource('residences', ResidencePageController::class)->middleware(['auth', 'verified']);
Route::resource('residence_users', ResidenceUserPageController::class)->middleware(['auth', 'verified']);
