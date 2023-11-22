<?php

use App\Http\Controllers\AdressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\produtoController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CoffeeController;

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
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth2', [AuthController::class, 'auth'])->name('auth');
Route::get('/cadastro', [AuthController::class, 'register'])->name('register');
Route::post('/registerClient',[AuthController::class, 'registerClient'])->name('registerClient');


Route::group(['middleware' => 'auth.check'], function(){

    Route::get('/carrinho',[CartController::class, 'index'])->name('cart');
    Route::get('/perfil',[CoffeeController::class, 'profile'])->name('profile');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/enderecos', [AdressController::class, 'newAdress'])->name('newAdress');
    Route::post('/registerAdress', [AdressController::class, 'registerAdress'])->name('registerAdress');
    Route::post('/addProdutoCart', [CartController::class, 'addProduto'])->name('cart.addProduto');
    Route::post('/deleteProd', [CartController::class, 'deleteProd'])->name('cart.deleteProd');
});

Route::prefix('admin')->group(function(){

    Route::group(['middleware' => 'auth.admin.check'], function(){

        Route::get('/', function(){
            return view('Admin.index');
        });
    
        Route::post('/registerAdmin',[AuthController::class,'registerAdmin']);
    
        Route::resource('produtos', produtoController::class);
        Route::resource('usuarios', UsuariosController::class);

    });

});