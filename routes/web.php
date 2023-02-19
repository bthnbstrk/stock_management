<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontendController::class, 'login']);
Route::get('/home', [FrontendController::class, 'home']);
Route::get('/products', [FrontendController::class, 'productList']);
Route::get('/products/product-form', [FrontendController::class, 'productForm']);
Route::get('/customers', [FrontendController::class, 'customerList']);
Route::get('/customers/customer-form', [FrontendController::class, 'customerForm']);
Route::get('/orders', [FrontendController::class, 'orderList']);
Route::get('/orders/order-form', [FrontendController::class, 'orderForm']);
Route::get('/stock', [FrontendController::class, 'stockList']);
Route::get('/stock/stock-form', [FrontendController::class, 'stockForm']);
Route::get('/logout', [FrontendController::class, 'logout']);
