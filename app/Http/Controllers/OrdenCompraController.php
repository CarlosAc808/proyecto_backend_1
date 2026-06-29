<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdenCompra;
use App\Models\DetalleOrdenCompra;

class OrdenCompraController extends Controller
{
    public function addOrdenCompra(Request $request)
    {
        $data = $request->all();

        // Validación básica
        if (
            !isset($data['proveedor_id']) ||
            !isset($data['fecha']) ||
            !isset($data['medicamentos']) ||
            !is_array($data['medicamentos']) ||
            count($data['medicamentos']) === 0
        ) {
            return response()->json([
                'message' => 'Faltan datos para crear la orden de compra'
            ], 422);
        }

        // Crear orden principal
        $orden = new OrdenCompra();
        $orden->proveedor_id = $data['proveedor_id'];
        $orden->fecha = $data['fecha'];
        $orden->save();

        // Guardar detalle de medicamentos
        foreach ($data['medicamentos'] as $med) {
            $detalle = new DetalleOrdenCompra();

            $detalle->orden_compra_id = $orden->id;
            $detalle->unidades = $med['unidades'] ?? 0;
            $detalle->descripcion = $med['descripcion'] ?? null;
            $detalle->precio = $med['precio'] ?? 0;

            // Caso 1: el usuario eligió "Otro medicamento"
            if (($med['medicamento_id'] ?? '') === 'otro') {
                $detalle->medicamento_id = null;
                $detalle->medicamento_manual = $med['nombrePersonalizado'] ?? null;
            } else {
                // Caso 2: eligió medicamento existente de la BD
                $detalle->medicamento_id = $med['medicamento_id'] ?? null;
                $detalle->medicamento_manual = null;
            }

            $detalle->save();
        }

        return response()->json([
            'message' => 'Orden de compra guardada con éxito',
            'id' => $orden->id
        ], 201);
    }

    public function getOrdenesCompra()
    {
        $ordenes = OrdenCompra::with([
            'proveedor',
            'detalles.medicamento'
        ])->get();

        return response()->json($ordenes, 200);
    }

    public function getOrdenCompra($id)
    {
        $orden = OrdenCompra::with([
            'proveedor',
            'detalles.medicamento'
        ])->find($id);

        if (!$orden) {
            return response()->json([
                'message' => 'Orden de compra no encontrada'
            ], 404);
        }

        return response()->json($orden, 200);
    }

    public function deleteOrdenCompra($id)
    {
        $orden = OrdenCompra::find($id);

        if (!$orden) {
            return response()->json([
                'message' => 'Orden de compra no encontrada'
            ], 404);
        }

        $orden->delete();

        return response()->json([
            'message' => 'Orden de compra eliminada con éxito'
        ], 200);
    }
}