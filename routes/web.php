<?php

use Carbon\Carbon;
use App\Models\Producto;

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

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

/*
|--------------------------------------------------------------------------
| Rutas En Las que se necesita estar Autenticado
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    //Users
    Route::get('/users/ajax', 'UserController@ajaxUsers');
    Route::resource('users', 'UserController');

    //Clients
    Route::get('/vehiculos/ajax', 'VehiculoController@ajaxVehiculos');
    Route::get('/vehiculos/cantidad', 'VehiculoController@ajaxCantidad');
    Route::resource('vehiculos', 'VehiculoController');
});
