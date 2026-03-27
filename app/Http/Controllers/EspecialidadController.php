<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Especialidad;

class EspecialidadController extends Controller
{
    //  GET /api/especialidades
    public function index()
    {
        $especialidades = Especialidad::orderBy('nombre')->get();

        return response()->json($especialidades);
    }

    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:150|unique:especialidades,nombre'
    ]);

    $especialidad = Especialidad::create([
        'nombre' => $request->nombre
    ]);

    return response()->json([
        'mensaje' => 'Especialidad creada',
        'especialidad' => $especialidad
    ], 201);
}
}