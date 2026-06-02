<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use Illuminate\Http\Request;

class ConsultorioController extends Controller
{
    public function index()
    {
        return response()->json(
            Consultorio::where('activo', true)->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'clinica_id' => 'required|exists:clinicas,id',
            'nombre' => 'required|max:100',
            'numero' => 'required|max:20',
            'piso' => 'nullable|max:20',
            'descripcion' => 'nullable'
        ]);

        $consultorio = Consultorio::create([
            'clinica_id' => $request->clinica_id,
            'nombre' => $request->nombre,
            'numero' => $request->numero,
            'piso' => $request->piso,
            'descripcion' => $request->descripcion,
            'activo' => true
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Consultorio registrado correctamente',
            'consultorio' => $consultorio
        ]);
    }

    public function destroy($id)
    {
        $consultorio = Consultorio::findOrFail($id);

        $consultorio->delete();

        return response()->json([
            'success' => true,
            'message' => 'Consultorio eliminado'
        ]);
    }
}