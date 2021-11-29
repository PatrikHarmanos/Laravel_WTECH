<?php

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
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

Route::get('/welcome/', [
    'uses' => 'App\Http\Controllers\ProductsController@getWelcome',
    'as' => 'welcome'
]);

Route::get('/add-to-cart/{id}', [
   'uses' => 'App\Http\Controllers\ProductsController@getAddToCart',
    'as' => 'product.addToCart'
]);

Route::get('/add-to-cart-auth/{id}', [
    'uses' => 'App\Http\Controllers\CartController@getAddToCartAuth',
    'as' => 'auth.product.addToCart'
]);

Route::get('/shopping-cart-auth/', [
    'uses' => 'App\Http\Controllers\CartController@getCartAuth',
    'as' => 'auth.product.shoppingCart'
]);

Route::get('/plus-one-to-cart-auth/{id}', [
    'uses' => 'App\Http\Controllers\CartController@getPlusOneToCartAuth',
    'as' => 'auth.product.plusOneToCart'
]);

Route::get('/minus-one-to-cart-auth/{id}', [
    'uses' => 'App\Http\Controllers\CartController@getMinusOneToCartAuth',
    'as' => 'auth.product.minusOneToCart'
]);

Route::get('/remove-from-cart-auth/{id}', [
    'uses' => 'App\Http\Controllers\CartController@getRemoveFromCartAuth',
    'as' => 'auth.product.removeFromCart'
]);

Route::get('/plus-one-to-cart/{id}', [
    'uses' => 'App\Http\Controllers\ProductsController@getPlusOneToCart',
    'as' => 'product.plusOneToCart'
]);

Route::get('/minus-one-to-cart/{id}', [
    'uses' => 'App\Http\Controllers\ProductsController@getMinusOneToCart',
    'as' => 'product.minusOneToCart'
]);

Route::get('/remove-from-cart/{id}', [
    'uses' => 'App\Http\Controllers\ProductsController@getRemoveFromCart',
    'as' => 'product.removeFromCart'
]);

Route::get('/shopping-cart/', [
    'uses' => 'App\Http\Controllers\ProductsController@getCart',
    'as' => 'product.shoppingCart'
]);

Route::get('/profile/', [
    'uses' => 'App\Http\Controllers\ProductsController@getProfile',
    'as' => 'profile'
]);

Route::get('/checkout', [
    'uses' => 'App\Http\Controllers\ProductsController@getCheckout',
    'as' => 'checkout'
]);

Route::get('/checkout-auth', [
    'uses' => 'App\Http\Controllers\CartController@getCheckoutAuth',
    'as' => 'auth.checkout'
]);

Route::get('/finish-order-auth', [
    'uses' => 'App\Http\Controllers\CartController@finishOrderAuth',
    'as' => 'auth.finishOrder'
]);

Route::get('/finish-order', [
    'uses' => 'App\Http\Controllers\ProductsController@finishOrder',
    'as' => 'finishOrder'
]);

Route::get('/dashboard', function () {
    $user = Auth::user();
    $products = Product::paginate(8);
    return view('products.index')->with('products', $products)->with('category', 'Vsetky kategorie')->with('user', $user);
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/logout', 'App\Http\Controllers\LogoutController@perform')->name('logout.perform');
});

require __DIR__.'/auth.php';
