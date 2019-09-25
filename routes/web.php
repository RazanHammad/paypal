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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/item','itemsController@index' );
Route::get('/item/{id}','itemsController@show' );
Route::get('/pay','paymentController@paywithpaypal')->name('pay');
Route::post('/pay','paymentController@paywithpaypal')->name('pay');
Route::get('/canceled','paymentController@canceled')->name('canceled');
Route::get('/status','paymentController@status')->name('status');
//Route::resource('/item','itemsController' );
