<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\FavoriteController;

use App\Models\Favorite;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UserController::class, 'index']);


/* Route::get('/', function () {
    return view('welcome');
}); */

Route::post('/admin/login', [AdminController::class, 'login']);
Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('admin.login');

Route::post('/admin/register', [AdminController::class, 'register']);
Route::get('/admin/register', [AdminController::class, 'registerForm'])->name('register');

Route::post('/user/login', [UserController::class, 'login']);
Route::get('/user/login', [UserController::class, 'loginForm']);

Route::post('/user/register', [UserController::class, 'register']);
Route::get('/user/register/{email}', [UserController::class, 'registerForm'])->name('register');

Route::middleware('auth.admin')->group(function () {
    Route::get('/admin', [ProductController::class, 'index']);

    Route::get('/admin/products', [ProductController::class, 'products']);
    Route::get('/admin/createProduct', [ProductController::class, 'create']);
    Route::post('/admin/storeProduct', [ProductController::class, 'store']);
    Route::get('/admin/editProduct/{id}', [ProductController::class, 'edit']);
    Route::post('/admin/updateProduct', [ProductController::class, 'update']);
    Route::get('/admin/destroyProduct/{id}', [ProductController::class, 'destroy']);
    Route::get('/admin/restoreProduct/{id}', [ProductController::class, 'restore']);
    
    Route::get('/admin/categories', [CategoryController::class, 'index']);
    Route::get('/admin/createCategory', [CategoryController::class, 'create']);
    Route::post('/admin/storeCategory', [CategoryController::class, 'store']);
    Route::get('/admin/editCategory/{id}', [CategoryController::class, 'edit']);
    Route::post('/admin/updateCategory', [CategoryController::class, 'update']);
    Route::get('/admin/destroyCategory/{id}', [CategoryController::class, 'destroy']);
    Route::get('/admin/restoreCategory/{id}', [CategoryController::class, 'restore']);

    Route::get('/admin/users', [UserController::class, 'users']);
    Route::get('/admin/orderItems/{id}', [OrderController::class, 'orderItems']);
    Route::get('/admin/orders', [OrderController::class, 'index']);
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

});

Route::middleware('auth.user')->group(function () {
    Route::get('/user', [UserController::class, 'userIndex']);
    Route::get('/addToCart/{id}', [CartController::class, 'addToCart']);
    Route::get('/addToFavorite/{id}', [FavoriteController::class, 'addToFavorite']);
    Route::get('/removeFromFavorite/{id}', [FavoriteController::class, 'removeFromFavorite']);
    Route::get('/increaseItem/{id}', [CartController::class, 'increaseItem']);
    Route::get('/decreaseItem/{id}', [CartController::class, 'decreaseItem']);
    Route::get('/removeItemFromCart/{id}', [CartController::class, 'removeItemFromCart']);
    Route::get('/checkout/{cartItems}', [OrderController::class, 'checkout']);
    Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');

});