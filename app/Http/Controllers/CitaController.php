<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Paciente;
use Carbon\Carbon;
use App\Models\Usuario;

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

public function cambiarEstado(Request $request, $id)
{
    $cita = Cita::findOrFail($id);
    $cita->estado = $request->estado;
    $cita->save();

    return response()->json(["ok" => true]);
}


//  Obtener citas del paciente logueado
public function citasPorPaciente($paciente_id)
{
    $citas = Cita::with([
        'doctor.usuario:id,nombre'
    ])
    ->where('paciente_id', $paciente_id)
    ->orderBy('fecha_fin', 'asc')
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


public function crearCitaPaciente(Request $request)
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
        'fecha_inicio' => now(),
        'fecha_fin' => $request->fecha_fin,
        'estado' => 'pendiente',
        'motivo' => $request->motivo
    ]);

    return response()->json([
        "message" => "Cita agendada correctamente",
        "data" => $cita
    ], 201);
}

// Obtener citas del doctor asignado al paciente
public function citasDelDoctorPorPaciente($paciente_id)
{
    // 1. obtener el paciente
    $paciente = Paciente::findOrFail($paciente_id);

    // 2. obtener citas del doctor de ese paciente
    $citas = Cita::where('doctor_id', $paciente->doctor_id)
        ->get(['fecha_fin']);

    return response()->json($citas);
}

public function storeDesdePaciente(Request $request)
{
    // 1️⃣ Validar datos
    $request->validate([
        'usuario_id' => 'required',
        'fecha_fin' => 'required'
    ]);

    // 2️⃣ Buscar el paciente usando el usuario
    $paciente = Paciente::where('usuario_id', $request->usuario_id)->first();

    if (!$paciente) {
        return response()->json([
            'message' => 'Paciente no encontrado'
        ], 404);
    }

    // 3️⃣ Calcular fecha_inicio (30 minutos antes)
    $fecha_inicio = Carbon::parse($request->fecha_fin)->subMinutes(30);

    // 4️⃣ Crear la cita con TODOS los datos correctos
    $cita = Cita::create([
        'doctor_id'    => $paciente->doctor_id,
        'paciente_id'  => $paciente->id,
        'clinica_id'   => $paciente->doctor->clinica_id ?? null,
        'fecha_inicio' => $fecha_inicio,
        'fecha_fin'    => $request->fecha_fin,
        'estado'       => 'pendiente',
        'motivo'       => $request->motivo ?? 'Consulta general'
    ]);

    return response()->json([
        'message' => 'Cita creada correctamente',
        'cita' => $cita
    ]);
}

public function obtenerDoctorPaciente($usuario_id)
{
    $paciente = Paciente::where('usuario_id', $usuario_id)->first();

    if (!$paciente) {
        return response()->json(['message' => 'Paciente no encontrado'], 404);
    }

    return response()->json([
        'doctor_id' => $paciente->doctor_id
    ]);
}
}