<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', function () {
    return view('home');
});

// Product controller routes
Route::middleware('admin.auth')->group(function () {
    
Route::get('/home', function () {
    return view('home');
});
    Route::get('/create', [ProductController::class, 'create'])->name('product.store');
    Route::post('/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/index', [ProductController::class, 'index'])->name('index');
    Route::get('show/{product}', [ProductController::class, 'show'])->name('show');
    Route::get('edit/{product}', [ProductController::class, 'edit'])->name('edit');
    Route::put('edit/{product}', [ProductController::class, 'update'])->name('update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
});

// User routes
Route::middleware('admin.auth')->group(function () {
    Route::get('/users', [UserController::class, 'users'])->name('users');
    Route::get('/create_user', [UserController::class, 'create_user'])->name('user.store_user');
    Route::post('/store_user', [UserController::class, 'store_user'])->name('user.store_user');
    Route::get('show_user/{user}', [UserController::class, 'show_user'])->name('show_user');
    Route::get('edit_user/{user}', [UserController::class, 'edit_user'])->name('edit_user');
    Route::put('edit_user/{user}', [UserController::class, 'update_user'])->name('update_user');
    Route::delete('/users/{user}', [UserController::class, 'destroy_user'])->name('destroy_user');
});

// Authentication routes
Route::get('admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'login']);
Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
Route::get('/admin/register', [AuthController::class, 'showRegistrationForm'])->name('admin.register');
Route::post('/admin/register', [AuthController::class, 'register']);