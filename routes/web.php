<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstacionamientoController;
use App\Http\Controllers\TarifaController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\ListadoVehiculosController;
use App\Http\Controllers\CerrarEstacionamiento;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\GananciasController;

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



// cierre ganancia fecha , dinero

Route::get('/', [InicioController::class, 'index'])->name('inicio');

//route para espacios de estacionamiento
Route::resource('estacionamiento', EstacionamientoController::class)->only('index','update')->names('estacionamiento');

//route para ingreso y salida de vehiculos
Route::resource('vehiculo', VehiculoController::class)->only('index','update', 'destroy')->names('vehiculo');

//lista de vehiculos
Route::get('vehiculos', [ListadoVehiculosController::class, 'lista'])->name('vehiculos.lista');

//lista de vehiculos eliminados
Route::get('historial', [ListadoVehiculosController::class, 'borrados'])->name('historial.borrados');

//Cerrar Estacionamiento
Route::get('cerrar', [CerrarEstacionamiento::class, 'index'])->name('cerrar.index');

//Route Ganancias
Route::get('ganancias', [GananciasController::class, 'ganancias'])->name('ganancias.index');

//route de caja
Route::get('caja', [CajaController::class, 'listado'])->name('caja.listado');
Route::get('diario', [CajaController::class, 'cierre'])->name('cierre.diario');

//route imprimir ticket
Route::post('ticket', [VehiculoController::class, 'ticket'])->name('ticket');
Route::get('ticket/{vehiculo}', [VehiculoController::class, 'ticket_imprimir'])->name('ticket.imprimir');

//route imprimir ticket salida
Route::get('salida/{vehiculo}', [VehiculoController::class, 'ticket_salida'])->name('salida.imprimir');


Route::get('buscar', [VehiculoController::class, 'buscar'])->name('buscar');

//route para actalizacion de tarifa
Route::put('tarifa/{tarifa}',[TarifaController::class, 'update'])->name('tarifa.update');
Route::put('minuto/{minuto}',[TarifaController::class, 'minuto'])->name('tarifa.minuto');


