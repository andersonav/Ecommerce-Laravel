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
    return view('index');
});

Route::get('/singleProduct/{id}', 'ProdutoController@singleProduct')->name('singleProduct');
Route::get('/addPedido/{id}', 'PedidoController@addPedido')->name('addPedido');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
