<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;



Route::get('/', function () {
    return view('product.home');
})->middleware('auth');

Route::get('/add-product', function () {
    return view('product.add_product');
})->middleware('auth');


Route::get('/product-table', [ProductController::class, 'index'])->name('product-table')->middleware('auth');

// for update and edit product
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->middleware('auth');
Route::patch('/products/{product}', [ProductController::class, 'update'])->middleware('auth');

Route::post('/add-product', [ProductController::class, 'store'])->name('add-product');
Route::delete('/delete-product/{product}', [ProductController::class, 'destroy']);

//login and register
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);