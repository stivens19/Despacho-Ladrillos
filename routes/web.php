<?php

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
    return view('welcome');
});

Route::resource('/roles', 'RoleController')->except(['show','destroy','create']);
Route::resource('/users','UserController')->except(['show','create']);
Route::resource('/customers','CustomerController')->except(['show','create']);
Route::resource('/hornos', 'HornoController')->except(['show','create']);

Route::resource('/ladrillos', 'LadrilloController');


Route::resource('/pedidos', 'PedidoController');
Route::delete('/estados/{estado}', 'PedidoController@cambio')->name('pedidos.cambio');
Route::get('/pedcancel','PedidoController@cancelados')->name('pedidos.cancelados');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
