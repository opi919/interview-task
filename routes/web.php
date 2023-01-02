<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $data['products'] = Product::all();
    return view('welcome', $data);
});

Auth::routes();
Route::post('add-to-cart', [CartController::class, 'add'])->name('addToCart');
Route::get('delete-from-cart/{id}', [CartController::class, 'delete'])->name('deleteFromCart');

Route::get('checkout',[CheckoutController::class, 'index'])->name('checkout');
Route::post('add-voucher',[CheckoutController::class, 'addVoucher'])->name('addVoucher');
Route::post('store',[CheckoutController::class, 'store'])->name('order.store');

Route::get('orders',[OrderController::class, 'index'])->name('order.index');
