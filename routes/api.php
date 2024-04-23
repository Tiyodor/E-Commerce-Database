<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;

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

Route::get('/products/random', [ProductController::class, 'homeProducts']);

Route::get('/products/{id}', [ProductController::class, 'shows']);

Route::get('/products/checkout/{ids}', [ProductController::class, 'checkout']);

Route::get('/products/checkouts/{ids}', [ProductController::class, 'checkout']);

Route::get('/shop', [ProductController::class, 'shopView']);

Route::get('/recommended', [ProductController::class, 'recommended']);

Route::get('/products/category/{category}', [ProductController::class, 'byCategory']);

Route::post('/checkout', [CheckoutController::class, 'store']);

Route::get('/order/success/{checkoutid}', [CheckoutController::class, 'show'] );

// Route::post('/checkoutsum', [CheckoutController::class, 'checksum']);
