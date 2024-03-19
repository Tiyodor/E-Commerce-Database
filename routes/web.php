<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

//Route::get('/', function () {
 //   return view('welcome');
//});

 Route::get('/', [ProductController::Class,'index'] );
 Route::get('/create', [ProductController::Class,'create'] )->name('product.store');
 Route::post('/store', [ProductController::Class, 'store'])->name('product.store');
 Route::get('/index', [ProductController::Class,'index'])->name('index');
 Route::get('show/{product}', [ProductController::Class,'show'])->name('show');
 Route::get('edit/{product}', [ProductController::Class,'edit'])->name('edit');
 Route::put('edit/{product}', [ProductController::Class,'update'])->name('update');
 Route::delete('/{product}', [ProductController::Class, 'destroy'])->name('destroy');
