<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\EspecialidadController;

use App\Http\Controllers\DistribuidorController;
use App\Http\Controllers\AltaPacienteController;
use App\Http\Controllers\ConsultaController;

use App\Http\Controllers\DashboardFarmaciaController;



//Dashboard Farmacia
\Route::get('/dashboard-farmacia', [DashboardFarmaciaController::class, 'index']);

////////especialidades//////////
Route::get('/especialidades', [EspecialidadController::class, 'index']);
Route::post('/especialidades', [EspecialidadController::class, 'store']);
////////especialidades//////////

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

/////medicamentos////////////////
Route::get('/medicamentos', [MedicamentoController::class, 'listado'])->name('index_medicamentos');
Route::get('/medicamentos/formulario/{id?}', [MedicamentoController::class, 'formulario']);
Route::post('/medicamentos/operaciones', [MedicamentoController::class, 'operaciones']);
Route::get('/medicamentos/imagen/{nombre}', [MedicamentoController::class, 'mostrar_imagen']); 
Route::get('/categorias', [MedicamentoController::class, 'categorias']);

/////medicamentos////////////////






//-------------------------------------------prueba farmacias-------------------------------------------------


Route::post('/distribuidores', [DistribuidorController::class, 'addDistribuidor']);
Route::get('/MostrarDistribuidor', [DistribuidorController::class, 'getApiDistribuidor']);
Route::delete('/DeleteDistribuidor/{id}', [DistribuidorController::class, 'deleteDistribuidor']);

Route::put("UpdateDistribuidor/{id}",[DistribuidorController::class, "putApiUpdateDistribuidor"]);


//-------------------------------------------prueba Doctores-------------------------------------------------
Route::post('/AltaPaciente', [AltaPacienteController::class, 'addPaciente']);
Route::get('/MostrarPaciente', [AltaPacienteController::class, 'getApiPaciente']);


//-------------------------------------------Consulta--------------------------------------------------------
Route::post('/AddConsulta', [ConsultaController::class, 'addConsulta']);
Route::get('/MostrarConsulta', [ConsultaController::class, 'getApiConsulta']);













Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
