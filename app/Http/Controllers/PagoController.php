<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\HistorialPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagoController extends Controller
{
    public function registrarPago(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'monto' => 'required|numeric|min:0',
            'metodo_pago' => 'nullable|string',
            'estado_pago' => 'required|in:pagado,pendiente,cancelado'
        ]);

        DB::beginTransaction();

        try {
            // 1. Crear el registro en el historial de pagos
            $pago = HistorialPago::create([
                'usuario_id' => $request->usuario_id,
                'monto' => $request->monto,
                'fecha_pago' => now()->toDateString(),
                'metodo_pago' => $request->metodo_pago,
                'estado' => $request->estado_pago,
            ]);

            // 2. Si el pago fue exitoso ('pagado'), activamos al usuario
            if ($request->estado_pago === 'pagado') {
                $usuario = User::find($request->usuario_id);
                $usuario->update([
                    'activo' => 1,          // Campo tinyint original
                    'estado' => 'activo'    // Campo enum nuevo
                ]);
            }

            DB::commit();

            return response()->json([
                'mensaje' => 'Pago registrado y estado del usuario procesado.',
                'pago' => $pago
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'mensaje' => 'Ocurrió un error al procesar el pago.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}