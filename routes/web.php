<?php

use App\Http\Controllers\Api\DoctorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FakerController;
use App\Http\Controllers\SuscripcionController;
use App\Http\Controllers\HistorialSuscripcionesController;


Route::get('/historial-suscripciones/fake',[HistorialSuscripcionesController::class, 'generarFake']);
Route::get('/historial-pagos/fake',[HistorialSuscripcionesController::class, 'generarPagosFake']);
Route::get('/suscripciones/fake',[HistorialSuscripcionesController::class, 'generarSuscripcionesFake']);
Route::get('/faker', [FakerController::class, 'generarDatos']);
Route::get('/faker-medicamentos', [FakerController::class, 'generarMedicamentosFake']);
Route::get('/dashboard-farmacia', [FakerController::class, 'dashboardFarmacia']);
Route::get('/generar-caducidad', [FakerController::class, 'generarCaducidadDemo']);
Route::get('/faker-suscripciones', [SuscripcionController::class, 'faker']);
Route::get('/', function () {
    return view('welcome');
});

