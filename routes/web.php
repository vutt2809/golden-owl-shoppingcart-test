<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

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

Route::get('/', [CartController::class, 'index'])->name('home');

Route::prefix('cart')->group(function() {
    Route::get('/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/increase-quantity/{id}', [CartController::class, 'increaseQuantity'])->name('cart.increase');
    Route::get('/decrease-quantity/{id}', [CartController::class, 'decreaseQuantity'])->name('cart.decrease');
    Route::get('/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
});
