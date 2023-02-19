<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StatisticController;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => '/v1'], function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/refresh-token', [AuthController::class, 'refreshToken']);

    Route::group(['middleware' => ['jwt.verify']], function () {

        Route::group(["prefix" => "auth"], function () {
            Route::get('/logout', [AuthController::class, 'logout']);
            Route::post('/refresh', [AuthController::class, 'refresh']);
        });

        Route::group(["prefix" => "product"], function () {
            Route::post('/create', [ProductController::class, 'create']);
            Route::post('/update/{product_id}', [ProductController::class, 'update']);
            Route::delete('/delete/{product_id}', [ProductController::class, 'destroy']);
            Route::post('/list', [ProductController::class, 'list']);
            Route::get('/select/{product_id}', [ProductController::class, 'select']);
            Route::get('/count', [ProductController::class, 'count']);
            Route::get('/categories', [ProductController::class, 'categories']);
            Route::get('/all', [ProductController::class, 'all']);
            Route::get('/ajax-table', [ProductController::class, 'getProducts']);
        });

        Route::group(["prefix" => "customer"], function () {
            Route::post('/create', [CustomerController::class, 'create']);
            Route::get('/orders/{customer_id}', [CustomerController::class, 'orders']);
            Route::post('/update/{customer_id}', [CustomerController::class, 'update']);
            Route::delete('/delete/{customer_id}', [CustomerController::class, 'destroy']);
            Route::post('/list', [CustomerController::class, 'list']);
            Route::get('/select/{customer_id}', [CustomerController::class, 'select']);
            Route::get('/count', [CustomerController::class, 'count']);
            Route::get('/all', [CustomerController::class, 'all']);
            Route::get('/ajax-table', [CustomerController::class, 'getCustomers']);
        });


        Route::group(["prefix" => "order"], function () {
            Route::post('/create', [OrderController::class, 'create']);
            Route::delete('/delete/{order_id}', [OrderController::class, 'destroy']);
            Route::post('/list', [OrderController::class, 'list']);
            Route::get('/count', [OrderController::class, 'count']);
            Route::get('/select/{order_id}', [OrderController::class, 'select']);
            Route::post('/change-status/{order_id}/{status}', [OrderController::class, 'changeStatus']);
            Route::get('/ajax-table', [OrderController::class, 'getOrders']);
        });

        Route::group(["prefix" => "statistic"], function () {
            Route::get('/count', [StatisticController::class, 'statistic']);
        });

    });
});

