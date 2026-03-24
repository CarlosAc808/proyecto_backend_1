<?php

use App\Http\Controllers\Api\DoctorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FakerController;

Route::get('/faker', [FakerController::class, 'generarDatos']);
Route::get('/faker-medicamentos', [FakerController::class, 'generarMedicamentosFake']);
Route::get('/dashboard-farmacia', [FakerController::class, 'dashboardFarmacia']);
Route::get('/', function () {
    return view('welcome');
});

