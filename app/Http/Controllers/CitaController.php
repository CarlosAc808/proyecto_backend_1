<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Paciente;
use Carbon\Carbon;

class CitaController extends Controller
{
    //  Obtener pacientes del doctor logueado
    public function pacientesPorDoctor($doctor_id)
    {
        $pacientes = Paciente::where('doctor_id', $doctor_id)
            ->select('id', 'usuario_id')
            ->with('usuario:id,nombre')
            ->get();

        return response()->json($pacientes);
    }

    //  Crear cita
public function store(Request $request)
{
    $request->validate([
        'doctor_id' => 'required|exists:doctores,id',
        'paciente_id' => 'required|exists:pacientes,id',
        'fecha_fin' => 'required|date',
        'motivo' => 'required|string'
    ]);

    $cita = Cita::create([
        'doctor_id' => $request->doctor_id,
        'paciente_id' => $request->paciente_id,
        'fecha_inicio' => now(), // creación
        'fecha_fin' => $request->fecha_fin, // cita real
        'estado' => 'pendiente',
        'motivo' => $request->motivo
    ]);

    return response()->json([
        'message' => 'Cita creada correctamente',
        'data' => $cita
    ], 201);
}

public function citasPorDoctor($doctor_id)
{
    $citas = Cita::with([
        'paciente.usuario:id,nombre'
    ])
    ->where('doctor_id', $doctor_id)
    ->orderBy('fecha_fin', 'asc') // ordenadas por fecha
    ->get([
        'id',
        'doctor_id',
        'paciente_id',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'motivo'
    ]);

    return response()->json($citas);
}
}