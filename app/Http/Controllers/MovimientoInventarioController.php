<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimientoInventario;
use App\Models\Inventario;

class MovimientoInventarioController extends Controller
{
    
    // GUARDAR MOVIMIENTO
public function store(Request $request)
{
    try {

        $request->validate([
            'tipo' => 'required|in:entrada,salida',
            'medicamento_id' => 'required|exists:medicamentos,id',
            'cantidad' => 'required|numeric|min:1',
            'motivo' => 'nullable|string',
            'proveedor_id' => 'nullable|exists:distribuidores,id',
            'receta_id' => 'nullable|exists:recetas,id',
        ]);

        // REGLAS IMPORTANTES
        if ($request->tipo === "entrada" && !$request->proveedor_id) {
            return response()->json([
                'message' => 'Proveedor obligatorio para entradas'
            ], 400);
        }

        if ($request->tipo === "salida" && !$request->receta_id) {
            return response()->json([
                'message' => 'Receta obligatoria para salidas'
            ], 400);
        }

        // buscar inventario
        $inventario = Inventario::where('medicamento_id', $request->medicamento_id)->first();

        if (!$inventario) {
            return response()->json([
                'message' => 'No existe inventario para ese medicamento'
            ], 404);
        }

        // CONTROL DE STOCK
        if ($request->tipo == "entrada") {
            $inventario->stock += $request->cantidad;
        } else {

            if ($inventario->stock < $request->cantidad) {
                return response()->json([
                    'message' => 'Stock insuficiente'
                ], 400);
            }

            $inventario->stock -= $request->cantidad;
        }

        $inventario->save();

        // guardar movimiento
        $movimiento = MovimientoInventario::create([
            'inventario_id' => $inventario->id,
            'tipo' => $request->tipo,
            'cantidad' => $request->cantidad,
            'motivo' => $request->motivo,
            'proveedor_id' => $request->proveedor_id,
            'receta_id' => $request->receta_id,
            'usuario_id' => 1,
            'fecha_movimiento' => now()
        ]);

        return response()->json([
            'message' => 'Movimiento guardado correctamente',
            'data' => $movimiento
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error',
            'error' => $e->getMessage()
        ], 500);
    }
}

    // HISTORIAL
public function index()
{
    $movimientos = MovimientoInventario::with([
        'inventario.medicamento',
        'proveedor',
        'receta'
    ])
    ->orderBy('fecha_movimiento', 'desc')
    ->get();

    return response()->json($movimientos);
}

  // OBTENER SOLO MEDICAMENTOS (para SELECT)
    public function medicamentos()
    {
        $medicamentos = Medicamento::select('id', 'nombre')->get();

        return response()->json($medicamentos);
    }

    // STOCK ACTUAL POR MEDICAMENTO (OPCIONAL PRO)
    public function stock($medicamento_id)
    {
        $inventario = Inventario::where('medicamento_id', $medicamento_id)->first();

        if (!$inventario) {
            return response()->json([
                'message' => 'No hay inventario'
            ], 404);
        }

        return response()->json([
            'stock' => $inventario->stock
        ]);
    }
}