<?php

use App\Http\Controllers\EquipoController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\ImpresoraController;
use App\Http\Controllers\HistorialImpresoraController;
use App\Http\Controllers\CelularController;
use App\Http\Controllers\HistorialCelularController;
use App\Http\Controllers\TelefonoController;
use App\Http\Controllers\HistorialTelefonoController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ExcelHistorialController;



use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', [EquipoController::class, 'index']);

Route::get('/', function () {
    return view('inicio');
})->name('inicio.index');


Route::resource('equipos', EquipoController::class);

//Route::resource('equipos.historial', HistorialEquipoController::class)->except(['create', 'show']);
Route::get('/equipos/detalles/{equipo}', [EquipoController::class, 'verDetalles']);

// Si aún necesitas rutas específicas para HistorialEquipoController, puedes agregarlas aquí
//Route::get('/equipos/historial/{equipo}', [HistorialEquipoController::class, 'index'])->name('historial.index');
//Route::post('/equipos/historial/{equipo}/store', [HistorialEquipoController::class, 'store'])->name('historial.store');
//Route::get('/equipos/historial/{equipo}/edit/{historial}', [HistorialEquipoController::class, 'edit'])->name('historial.edit');
//Route::get('/equipos/historial/{equipo}/update/{historial}', [HistorialEquipoController::class, 'update'])->name('historial.update');
//Route::delete('/equipos/historial/{equipo}/{historial}', [HistorialEquipoController::class, 'destroy'])->name('historial.destroy');

Route::resource('impresoras', ImpresoraController::class, ['parameters' => [
    'impresoras' => 'impresora'
]]);


Route::resource('celulares', CelularController::class, ['parameters' => [
    'celulares' => 'celular'
]]);
 


Route::resource('telefonos', TelefonoController::class, ['parameters' => [
    'telefonos' => 'telefono'
]]);

// routes/web.php
Route::resource('mantenimientos', MantenimientoController::class);
Route::get('mantenimientos/{tipo}/{id}', [MantenimientoController::class, 'index'])->name('mantenimientos.index');
Route::post('mantenimientos/{tipo}/{id}', [MantenimientoController::class, 'store'])->name('mantenimientos.store');
Route::get('mantenimientos/{tipo}/{id}/edit/{mantenimientoId}', [MantenimientoController::class, 'edit'])->name('mantenimientos.edit');
Route::put('mantenimientos/{tipo}/{id}/{mantenimientoId}', [MantenimientoController::class, 'update'])->name('mantenimientos.update');
Route::delete('/mantenimientos/{tipo}/{id}/{mantenimientoId}', [MantenimientoController::class, 'destroy'])->name('mantenimientos.destroy');

Route::resource('historiales', HistorialController::class);
Route::get('historiales/{tipo}/{id}', [HistorialController::class, 'index'])->name('historiales.index');
Route::post('historiales/{tipo}/{id}', [HistorialController::class, 'store'])->name('historiales.store');
Route::get('historiales/{tipo}/{id}/edit/{historialId}', [HistorialController::class, 'edit'])->name('historiales.edit');
Route::put('historiales/{tipo}/{id}/{historialId}', [HistorialController::class, 'update'])->name('historiales.update');
Route::delete('/historiales/{tipo}/{id}/{historialId}', [HistorialController::class, 'destroy'])->name('historiales.destroy');


Route::resource('search',SearchController::class);
Route::get('/search', [SearchController::class, 'index'])->name('search.index');





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/exportar/{tipo}/{id}', [ExcelHistorialController::class, 'export'])->name('exportar.historial');
