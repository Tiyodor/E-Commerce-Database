<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/register', [AuthController::class, 'register']);

//home controller routes
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::resource('users', 'UserController');
Route::resource('products', 'ProductController');



// Product controller routes
    Route::prefix('items')->group(function(){
    Route::get('create', [ProductController::class, 'create'])->name('items.product.store');
    Route::post('store', [ProductController::class, 'store'])->name('items.product.store');
    Route::get('index', [ProductController::class, 'index'])->name('items.index');
    Route::get('show/{product}', [ProductController::class, 'show'])->name('items.show');
    Route::get('edit/{product}', [ProductController::class, 'edit'])->name('items.edit');
    Route::put('edit/{product}', [ProductController::class, 'update'])->name('items.update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('items.destroy')->withTrashed();
    Route::post('/{product}', [ProductController::class, 'restore'])->name('items.restore')->withTrashed();
    Route::get('archive', [ProductController::class, 'retrieveSoftDeleted'])->name('items.archive');
    Route::get('/search', [ProductController::class, 'search'])->name('items.search');


});


// Order Routes
    Route::prefix('order')->group(function(){
    Route::get('orders', [OrderController::class, 'index'])->name('order.orders');
    Route::get('create', [OrderController::class, 'create'])->name('order.store');
    Route::post('store', [OrderController::class, 'store'])->name('order.store');
    Route::get('show/{order}', [OrderController::class, 'show'])->name('order.show');
    Route::get('edits/{order}', [OrderController::class, 'edit'])->name('order.edit');
    Route::put('edits/{order}', [OrderController::class, 'update'])->name('order.update');
    Route::put('order/{id}', [OrderController::class, 'statusUpdate'])->name('order.statusUpdate');
    Route::delete('/{order}', [OrderController::class, 'destroy'])->name('order.destroy')->withTrashed();
    Route::post('/{order}', [OrderController::class, 'restore'])->name('order.restore')->withTrashed();
    Route::get('history', [OrderController::class, 'retrieveSoftDelete'])->name('order.history');
    Route::delete('/orders/{order}/cancelDestroy', [OrderController::class, 'cancelDestroy'])->name('order.cancelDestroy');
    Route::get('/search', [OrderController::class, 'search'])->name('order.search');


    // Route::post('cancel/{order}', [OrderController::class, 'cancel'])->name('order.cancel');


    });


    Route::prefix('user')->group(function(){
        // User routes
        Route::get('users', [UserController::class, 'users'])->name('user.users');
        Route::get('create_user', [UserController::class, 'create_user'])->name('user.store_user');
        Route::post('store_user', [UserController::class, 'store_user'])->name('user.store_user');
        Route::get('show_user/{user}', [UserController::class, 'show_user'])->name('user.show_user');
        Route::get('edit_user/{user}', [UserController::class, 'edit_user'])->name('user.edit_user');
        Route::put('edit_user/{user}', [UserController::class, 'update_user'])->name('update_user');
        Route::delete('/{user}', [UserController::class, 'destroy_user'])->name('user.destroy_user')->withTrashed();
        Route::post('/{user}', [UserController::class, 'restore'])->name('user.restore')->withTrashed();
        Route::get('archive', [UserController::class, 'retrieveSoftDelete'])->name('user.archive');
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

    });
