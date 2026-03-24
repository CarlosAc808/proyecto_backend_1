<?php

namespace App\Http\Controllers;
use App\Models\Consulta;
use Illuminate\Http\Request;
use App\Models\AltaPaciente;

class ConsultaController extends Controller
{
    public function addConsulta(Request $request)
{


    // validar que el paciente exista
    $paciente = AltaPaciente::find($request->pacienteId);

    if (!$paciente) {
        return response()->json([
            'error' => 'Paciente no encontrado'
        ], 404);
    }

    $consulta = new Consulta();

    $consulta->paciente_id = $paciente->id;

    $consulta->motivo = $request->motivo;
    $consulta->sintomas = $request->sintomas;
    $consulta->examen = $request->examen;
    $consulta->notas = $request->notas;
    //$consulta->fechaTratamiento = $request->fechaTratamiento;
    $consulta->fecha_tratamiento = $request->fechaTratamiento;

    $consulta->save();

    return response()->json([
        'message' => 'Consulta guardada correctamente'
    ]);
}

     public function getApiConsulta() {
     // Se usa el método all para obtener todos los formularios
     // "SELECT * FROM formularios"
    $consulta = Consulta::with('paciente')->get();
    return response()->json($consulta);
    }


public function getByPaciente($pacienteId)
{
    $consultas = Consulta::where('pacienteId', $pacienteId)
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json([
        'consultas' => $consultas
    ]);
}
}
