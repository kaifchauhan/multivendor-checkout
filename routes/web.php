<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});

// Route::post('/add-to-cart', [CartController::class, 'add']);
Route::post('/add-to-cart', [CartController::class, 'add']);

Route::get('/cart', [CartController::class, 'view']);

Route::get('/checkout', [CartController::class, 'checkout']);

Route::get('/admin/orders', [CartController::class, 'orders']);

Route::get('/', [CartController::class, 'home']);

Route::get('/cart-ui', [CartController::class, 'cartUI']);

Route::get('/admin/orders-ui', [CartController::class, 'adminUI']);

Route::get('/admin', function () {
    return view('admin-dashboard');
});

Route::get('/admin/vendors', [CartController::class, 'vendors']);
Route::post('/admin/vendors/add', [CartController::class, 'addVendor']);
Route::get('/admin/vendors/delete/{id}', [CartController::class, 'deleteVendor']);

Route::get('/admin/products', [CartController::class, 'products']);
Route::post('/admin/products/add', [CartController::class, 'addProduct']);
Route::get('/admin/products/delete/{id}', [CartController::class, 'deleteProduct']);