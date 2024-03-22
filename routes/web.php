<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;

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
Route::middleware('guest:admin')->group(function(){
    Route::get('/', function () {return view('auth.login');});

});

// Product controller routes
Route::middleware('admin.auth')->group(function () {

    Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/home', function () { return view('home');});
// Product controller routes
    Route::prefix('items')->group(function(){
    Route::get('create', [ProductController::class, 'create'])->name('items.product.store');
    Route::post('store', [ProductController::class, 'store'])->name('items.product.store');
    Route::get('index', [ProductController::class, 'index'])->name('items.index');
    Route::get('show/{product}', [ProductController::class, 'show'])->name('items.show');
    Route::get('edit/{product}', [ProductController::class, 'edit'])->name('items.edit');
    Route::put('edit/{product}', [ProductController::class, 'update'])->name('update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
    });


// Order Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');


    Route::prefix('user')->group(function(){
        // User routes
        Route::get('users', [UserController::class, 'users'])->name('user.users');
        Route::get('create_user', [UserController::class, 'create_user'])->name('user.store_user');
        Route::post('store_user', [UserController::class, 'store_user'])->name('user.store_user');
        Route::get('show_user/{user}', [UserController::class, 'show_user'])->name('user.show_user');
        Route::get('edit_user/{user}', [UserController::class, 'edit_user'])->name('user.edit_user');
        Route::put('edit_user/{user}', [UserController::class, 'update_user'])->name('update_user');
        Route::delete('users/{user}', [UserController::class, 'destroy_user'])->name('destroy_user');
    });

    //Format For Web Routes (Get data from controller, pass to blade)
    /*
        GET /user - Page of User Table
        GET /user/{id} - Show One of User
        GET /user/create - Create User Page
        POST /user - Store user
        GET /user/edit - Edit User Page
        PUT /user/{id} - Update User
        PATCH /user/{id} - Update single property of user
        DELETE /user/{id} - Delete User
    */

    //Format for API Routes (Only get data from controller, return as response)
    /*
        GET /user - List of users
        GET /user/{id} - Get User Data
        POST /user - Store User
        PUT /user/{id} - Update User
        PATCH /user/{id} - Update single property of user
        DELETE /user/{id} - Delete User
    */

});

// Authentication routes
    Route::middleware('guest:admin')->prefix('admin')->group(function(){
        Route::get('/', function () {return view('auth.login');});
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
        Route::middleware('throttle:5,1')->post('/login', [AuthController::class, 'login']);
        Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('admin.register');
        Route::post('/register', [AuthController::class, 'register']);
    });
