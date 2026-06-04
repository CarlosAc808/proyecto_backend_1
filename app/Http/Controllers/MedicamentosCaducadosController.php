<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicamentosCaducados;
use App\Models\Inventario;

class MedicamentosCaducadosController extends Controller
{
    // GUARDAR CADUCADO
    public function store(Request $request)
    {
        $request->validate([
            'medicamento_id' => 'required|exists:medicamentos,id',
            'cantidad' => 'required|numeric|min:1',
            'motivo' => 'nullable|string',
        ]);

        $inventario = Inventario::where('medicamento_id', $request->medicamento_id)->first();

        if (!$inventario) {
            return response()->json([
                'message' => 'No existe inventario para ese medicamento'
            ], 404);
        }

        $caducado = MedicamentosCaducados::create([
            'inventario_id' => $inventario->id,
            'cantidad' => $request->cantidad,
            'motivo' => $request->motivo,
        ]);

        return response()->json([
            'message' => 'Caducado registrado correctamente',
            'data' => $caducado,
        ], 201);
    }
}




