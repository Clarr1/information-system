<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;



Route::get('/', function () {
    return view('product.home');
})->middleware('auth');

Route::get('/add-product', function () {
    return view('product.add_product');
})->middleware('auth');

route::get('/purchase-product', [ProductController::class, 'purchase'])->name('purchase-product')->middleware('auth');

Route::post('/cart/add', [ProductController::class, 'addToCart']);
Route::post('/cart/remove', [ProductController::class, 'removeFromCart']);

// cart checkout purchase
Route::post('/purchase/checkout', [PurchaseController::class, 'store'])->name('purchase.checkout');


Route::get('/product-table', [ProductController::class, 'index'])->name('product-table')->middleware('auth');

// for update and edit product
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->middleware('auth');
Route::patch('/products/{product}', [ProductController::class, 'update'])->middleware('auth');

Route::post('/add-product', [ProductController::class, 'store'])->name('add-product');
Route::delete('/delete-product/{product}', [ProductController::class, 'destroy']);

// direct purchase
Route::post('/purchase', [PurchaseController::class, 'store'])
    ->name('purchase.store');

//login and register
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);