<?php

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

Route::view('/', 'welcome')->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/webhooks/stripe', 'WebhookController');

Route::get('/products/{product}', 'ProductController@show')->name('products.show');
Route::post('/products/{product}/purchase', 'ProductPurchaseController@store')->name('products.purchase');

Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart/add/{product}', 'CartController@add')->name('cart.add');
Route::post('/cart/checkout', 'CartCheckoutController@store')->name('cart.checkout');

Route::get('/orders', 'OrderController@index')->name('orders.index');
Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
