<?php

use App\Http\Controllers\AdressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\produtoController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CoffeeController;
use App\Http\Controllers\OrdersController;

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

Route::get('/', [CoffeeController::class, 'home'])->name('home');
Route::post('/auth2', [AuthController::class, 'auth'])->name('auth');
Route::post('/registerClient', [AuthController::class, 'registerClient'])->name('registerClient');

Route::group(['middleware' => 'auth.login'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/cadastro', [AuthController::class, 'register'])->name('register');
});


Route::group(['middleware' => 'auth.check'], function () {

    Route::get('/carrinho', [CartController::class, 'index'])->name('cart');
    Route::get('/perfil', [CoffeeController::class, 'profile'])->name('profile');
    Route::get('/pedidos', [CoffeeController::class, 'historicOrders'])->name('historicOrders');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/enderecos', [AdressController::class, 'newAdress'])->name('newAdress');
    Route::post('/registerAdress', [AdressController::class, 'registerAdress'])->name('registerAdress');
    Route::post('/addProdutoCart', [CartController::class, 'addProduto'])->name('cart.addProduto');
    Route::post('/deleteProd', [CartController::class, 'deleteProd'])->name('cart.deleteProd');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/UpdateProfile', [CoffeeController::class, 'UpdateProfile'])->name('UpdateProfile');
    Route::post('/deleteAdress', [AdressController::class, 'deleteAdress'])->name('deleteAdress');
});

Route::prefix('admin')->group(function () {

    Route::group(['middleware' => 'auth.admin.check'], function () {

        Route::get('/', [OrdersController::class, 'index'])->name('orders');
        Route::post('/cancelOrder', [OrdersController::class, 'cancelOrder'])->name('cancelOrder');
        Route::post('/confirmOrder', [OrdersController::class, 'confirmOrder'])->name('confirmOrder');
        Route::post('/closedmOrder', [OrdersController::class, 'closedmOrder'])->name('closedmOrder');
        Route::get('/Reports', [OrdersController::class, 'Reports'])->name('reports');

        Route::post('/registerAdmin', [AuthController::class, 'registerAdmin']);

        Route::resource('produtos', produtoController::class);
        Route::resource('usuarios', UsuariosController::class);
    });
});
