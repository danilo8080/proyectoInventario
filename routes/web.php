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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'App\Http\Controllers\LoginController@login')->name('login')->middleware('guest');

Route::POST('/','App\Http\Controllers\LoginController@authenticate')->name('authenticate');

Route::get('/logout','App\Http\Controllers\LoginController@logout')->name('logout');

Route::get('/index','App\Http\Controllers\DashboardController@index')->name('user.index');

Route::get('/dispositivos','App\Http\Controllers\DashboardController@dispositivos')->name('user.dispositivos');

Route::get('/caracteristicas','App\Http\Controllers\DashboardController@caracteristicas')->name('user.caracteristicas');

// empresas

Route::POST('/index','App\Http\Controllers\EmpresaController@crearEmpresa')->name('empresa.agregar');

Route::get('/cargarEmpresas','App\Http\Controllers\EmpresaController@getEmpresas')->name('empresa.cargar');

Route::get('/editarEmpresa/{id}','App\Http\Controllers\EmpresaController@editarEmpresa')->name('empresa.editar');

Route::PUT('/actualizarEmpresa/{id}','App\Http\Controllers\EmpresaController@actualizarEmpresa')->name('empresa.actualizar');

Route::DELETE('/eliminarEmpresa/{id}','App\Http\Controllers\EmpresaController@eliminarEmpresa')->name('empresa.eliminar');

//dispositivos

Route::POST('/agregarDispositivo','App\Http\Controllers\DispositivoController@crearDispositivo')->name('dispositivo.agregar');

Route::get('/cargarDispositivos','App\Http\Controllers\DispositivoController@getDispositivos')->name('dispositivo.cargar');

Route::get('/editarDispositivo/{id}','App\Http\Controllers\DispositivoController@editarDispositivo')->name('dispositivo.editar');

Route::PUT('/actualizarDispositivo/{id}','App\Http\Controllers\DispositivoController@actualizarDispositivo')->name('dispositivo.actualizar');

Route::DELETE('/eliminarDispositivo/{id}','App\Http\Controllers\DispositivoController@eliminarDispositivo')->name('dispositivo.eliminar');

//caracteristicas

Route::POST('/agregarCaracteristica','App\Http\Controllers\CaracteristicaController@crearCaracteristica')->name('caracteristica.agregar');

Route::get('/cargarCaracteristicas','App\Http\Controllers\CaracteristicaController@getCaracteristicas')->name('caracteristica.cargar');

Route::get('/editarCaracteristica/{id}','App\Http\Controllers\CaracteristicaController@editarCaracteristica')->name('caracteristica.editar');

Route::PUT('/actualizarCaracteristica/{id}','App\Http\Controllers\CaracteristicaController@actualizarCaracteristica')->name('caracteristica.actualizar');

Route::DELETE('/eliminarCaracteristica/{id}','App\Http\Controllers\CaracteristicaController@eliminarCaracteristica')->name('caracteristica.eliminar');
