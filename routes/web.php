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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('weather/{cityName}', 'WeatherController@getWeatherByCity')->name('weather');

Route::get('orders/index/past', 'OrderController@indexPast')->name('orders-past');

Route::get('orders/index/current', 'OrderController@indexCurrent')->name('orders-current');

Route::get('orders/index/new', 'OrderController@indexNew')->name('orders-new');

Route::get('orders/index/completed', 'OrderController@indexCompleted')->name('orders-completed');

Route::resource('orders', 'OrderController', ['only' => ['edit', 'update']]);

Route::resource('products', 'ProductController', ['only' => ['index']]);
