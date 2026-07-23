<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AsistenciaController extends Controller
{
    // Módulo del Doctor: Registrar entrada o salida
    public function stores(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctores,id',
            'tipo' => 'required|in:entrada,salida'
        ]);

        $doctorId = $request->doctor_id;
        $hoy = Carbon::today()->toDateString();
        $horaActual = Carbon::now()->toTimeString();

        // Buscar asistencia activa del doctor (entrada registrada sin salida aún)
        $asistenciaActiva = Asistencia::where('doctor_id', $doctorId)
            ->whereNull('hora_salida')
            ->latest('id')
            ->first();

        DB::beginTransaction();

        try {
            if ($request->tipo === 'entrada') {
                if ($asistenciaActiva) {
                    return response()->json(['error' => 'Ya te encuentras con una entrada activa.'], 400);
                }

                $asistencia = Asistencia::create([
                    'doctor_id' => $doctorId,
                    'fecha' => $hoy,
                    'hora_entrada' => $horaActual,
                ]);

                DB::commit();
                return response()->json(['message' => 'Entrada registrada con éxito.', 'asistencia' => $asistencia], 201);
            }

            if ($request->tipo === 'salida') {
                if (!$asistenciaActiva) {
                    return response()->json(['error' => 'No tienes un registro de entrada activo para hoy.'], 400);
                }

                // Calcular tiempo transcurrido
                $entradaTime = Carbon::parse($asistenciaActiva->fecha . ' ' . $asistenciaActiva->hora_entrada);
                $salidaTime = Carbon::now();
                $diff = $entradaTime->diff($salidaTime);

                // Formatear el total (ej: "08h 30m")
                $horasTrabajadas = sprintf('%02dh %02dm', $diff->h + ($diff->days * 24), $diff->i);

                $asistenciaActiva->update([
                    'hora_salida' => $horaActual,
                    'horas_trabajadas' => $horasTrabajadas
                ]);

                DB::commit();
                return response()->json(['message' => 'Salida registrada con éxito.', 'asistencia' => $asistenciaActiva], 200);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error de base de datos.', 'detalle' => $e->getMessage()], 500);
        }
    }

    // Módulo de la Clínica: Historial consolidado de asistencias de todo el personal
    public function clinicIndex(Request $request)
    {
        $query = Asistencia::with(['doctor.usuario', 'doctor.especialidad']);

        // Filtro dinámico por rango de fechas
        if ($request->filled('fecha_inicio')) {
            $query->whereDate('fecha', '>=', $request->fecha_inicio);
        }
        if ($request->filled('fecha_fin')) {
            $query->whereDate('fecha', '<=', $request->fecha_fin);
        }

        $asistencias = $query->orderBy('fecha', 'desc')
                             ->orderBy('hora_entrada', 'desc')
                             ->get();

        return response()->json($asistencias);
    }

    // Módulo del Doctor: Historial de asistencia individual
    public function doctorIndex(Request $request, $id)
    {
        $query = Asistencia::where('doctor_id', $id);

        if ($request->filled('fecha')) {
            $query->whereDate('fecha', $request->fecha);
        }

        $historial = $query->orderBy('fecha', 'desc')
                           ->orderBy('hora_entrada', 'desc')
                           ->get();

        // Determinar presencia actual del doctor
        $estaDentro = Asistencia::where('doctor_id', $id)
            ->whereNull('hora_salida')
            ->exists();

        return response()->json([
            'estado_actual' => $estaDentro ? 'dentro' : 'fuera',
            'historial' => $historial
        ]);
    }
}