<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

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
Route::resource('products', ProductsController::class);

Route::get('/add-to-cart/{id}', [
   'uses' => 'App\Http\Controllers\ProductsController@getAddToCart',
    'as' => 'product.addToCart'
]);

Route::get('/remove-from-cart/{id}', [
    'uses' => 'App\Http\Controllers\ProductsController@getRemoveFromCart',
    'as' => 'product.removeFromCart'
]);

Route::get('/shopping-cart/', [
    'uses' => 'App\Http\Controllers\ProductsController@getCart',
    'as' => 'product.shoppingCart'
]);

Route::get('/checkout', [
    'uses' => 'App\Http\Controllers\ProductsController@getCheckout',
    'as' => 'checkout'
]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
