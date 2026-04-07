<?php

use App\Http\Controllers\DoctorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\MovimientoInventarioController;
use App\Http\Controllers\DistribuidorController;
use App\Http\Controllers\AltaPacienteController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\DashboardFarmaciaController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\NotificacionesController;

Route::get('/recetas/paciente/{id}', [ConsultaController::class, 'recetasPorPaciente']);
Route::get('/consulta/paciente/{id}/ultima', [ConsultaController::class, 'ultimaConsultaConReceta']);

Route::get('/citas/paciente/{id}/futuras', [CitaController::class, 'citasFuturas']);
Route::get('/citas/paciente/{id}/pasadas', [CitaController::class, 'citasPasadas']);

Route::get('/paciente/doctores/{usuarioId}', [CitaController::class, 'getDoctores']);
Route::get('/paciente/doctor/{usuario_id}', [CitaController::class, 'obtenerDoctorPaciente']);
Route::get('/citas/paciente/{paciente_id}', [CitaController::class, 'citasDelDoctorPorPaciente']);
Route::post('/citas/paciente', [CitaController::class, 'storeDesdePaciente']);
Route::get('/tratamientos-largos/{doctor_id}', [ConsultaController::class, 'tratamientosLargos']);
Route::get('/usuario/foto/{nombre}', [UsuarioController::class, 'obtenerFotoUsuario']);

Route::put('/citas/{id}/estado', [CitaController::class, 'cambiarEstado']);
Route::get('/pacientes-doctor/{doctor_id}', [CitaController::class, 'pacientesPorDoctor']);
Route::post('/citas', [CitaController::class, 'store']);
Route::get('/citas-doctor/{doctor_id}', [CitaController::class, 'citasPorDoctor']);

///////////RUTAS MOVIMIENTO INVENTARIO//////////
Route::get('/medicamentosselct', [MedicamentoController::class, 'index']);
Route::get('/proveedores', [DistribuidorController::class, 'proveedores']);
Route::get('/recetas', [RecetaController::class, 'recetas']);
Route::get('/recetas/farmacia', [RecetaController::class, 'index']);
Route::get('/recetas/stats', [RecetaController::class, 'stats']);
Route::get('/movimientos', [MovimientoInventarioController::class, 'index']);
Route::post('/guardarMovimientos', [MovimientoInventarioController::class, 'store']);
///////////RUTAS MOVIMIENTO INVENTARIO//////////


//Dashboard Farmacia
Route::get('/dashboard-farmacia', [DashboardFarmaciaController::class, 'index']);
Route::get('/dashboard-farmacia/imagen/{nombre_imagen}', [DashboardFarmaciaController::class, 'mostrar_imagen_usuario']);

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
Route::get('/distribuidores/select', [DistribuidorController::class, 'getDistribuidoresSelect']);
Route::put("UpdateDistribuidor/{id}",[DistribuidorController::class, "putApiUpdateDistribuidor"]);


//-------------------------------------------prueba Doctores-------------------------------------------------
Route::post('/AltaPaciente', [AltaPacienteController::class, 'addPaciente']);
Route::get('/MostrarPaciente', [AltaPacienteController::class, 'getApiPaciente']);


//-------------------------------------------Consulta--------------------------------------------------------
Route::post('/AddConsulta', [ConsultaController::class, 'addConsulta']);
Route::get('/MostrarConsulta', [ConsultaController::class, 'getApiConsulta']);
Route::post('/finalizar-consulta', [ConsultaController::class, 'finalizarConsulta']);


///erick
Route::get('/consultas/{pacienteId}', [ConsultaController::class, 'getByPaciente']);
use App\Http\Controllers\PerfilController;

Route::post('/perfil/actualizar', [PerfilController::class, 'actualizarPerfil']);

// Obtener notificaciones del usuario
Route::get('/notificaciones/{usuario_id}', [NotificacionesController::class, 'obtenerNotificaciones']);

// Activar / desactivar notificación
Route::post('/notificaciones/toggle', [NotificacionesController::class, 'toggleNotificacion']);

Route::post('/perfil/cambiar-password', [PerfilController::class, 'cambiarPassword']);


Route::get('/perfil/doctor/{usuario_id}', [PerfilController::class, 'obtenerDoctor']);

Route::get('/perfil/{id}', [PerfilController::class, 'obtenerPerfil']);













Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/doctores',[DoctorController::class,'index']);
Route::post('/doctores',[DoctorController::class,'store']);
Route::put('/doctores/{id}',[DoctorController::class,'update']);
Route::delete('/doctores/{id}',[DoctorController::class,'destroy']);
