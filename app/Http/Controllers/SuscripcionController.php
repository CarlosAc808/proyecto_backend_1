<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suscripciones;
use App\Models\Planes;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Historialsuscripciones;

class SuscripcionController extends Controller
{
    public function AddSuscripcion(Request $request)
{
    $data = $request->all();

    // Buscar el plan
    $plan = Planes::find($data['plan_id']);

    if (!$plan) {
        return response()->json([
            'error' => 'Plan no encontrado'
        ], 404);
    }

    // Desactivar suscripción anterior
    /*
    Suscripciones::where('usuario_id', $data['usuario_id'])
        ->where('estado', 'activo')
        ->update(['estado' => 'inactivo']);
    */

$esNuevo = false;

$suscripcion = Suscripciones::where('usuario_id', $data['usuario_id'])
    ->first();

$planAnterior = null;

if (!$suscripcion) {
    $suscripcion = new Suscripciones();
    $suscripcion->usuario_id = $data['usuario_id'];
    $esNuevo = true;
} else {
    $planAnterior = $suscripcion->plan_id;
}

    $suscripcion->usuario_id = $data['usuario_id'];
    $suscripcion->plan_id = $data['plan_id'];
    $suscripcion->estado = 'activo';
    $suscripcion->fecha_inicio = now();
    $suscripcion->fecha_fin = now()->addDays($plan->duracion_dias);
    $suscripcion->creado_en = now();

    $suscripcion->save();

    ///////////////Nuevo historial /////////////////


            // Determinar tipo de cambio
        $tipoCambio = 'CREACION';

        if (!$esNuevo) {
            $planAnteriorObj = Planes::find($planAnterior);

            if ($planAnteriorObj) {
                if ($plan->precio > $planAnteriorObj->precio) {
                    $tipoCambio = 'UPGRADE';
                } elseif ($plan->precio < $planAnteriorObj->precio) {
                    $tipoCambio = 'DOWNGRADE';
                } else {
                    $tipoCambio = 'CAMBIO_PLAN';
                }
            }
        }

        Historialsuscripciones::create([
    'suscripcion_id' => $suscripcion->id,
    'previous_plan_id' => $planAnterior,
    'new_plan_id' => $suscripcion->plan_id,
    //'changed_type' => $esNuevo ? 'CREACION' : 'CAMBIO_PLAN',
    //'changed_type' => $planAnterior ? 'CAMBIO_PLAN' : 'CREACION',
    'changed_type' => $tipoCambio,
    'created_at' => now()
]);

    //////////

    return response()->json([
        'message' => 'Suscripción creada',
        'suscripcion' => $suscripcion
    ]);
}






/*

    $suscripcion = Suscripciones::where('usuario_id', $usuario->id)
        ->where('estado', 'activo')
        ->whereDate('fecha_fin', '>=', now())
        ->first();

    
    if (!$suscripcion) {
        return response()->json([
            'error' => 'Tu suscripción ha expirado o no tienes plan'
        ], 403);
    }

    return response()->json([
        'message' => 'Login correcto',
        'usuario' => $usuario,
        'suscripcion' => $suscripcion
    ]);
*/

public function faker(Request $request)
    {
        $cantidad = $request->input('cantidad', 100);

        for ($i = 0; $i < $cantidad; $i++) {

            $inicio = Carbon::now()->subDays(rand(1, 180));

            DB::table('suscripciones')->insert([
                'usuario_id' => rand(1, 72),
                'plan_id' => rand(1, 3),
                'estado' => fake()->randomElement([
                    'activo',
                    'activo',
                    'activo',
                    'activo',
                    'inactivo'
                ]),
                'fecha_inicio' => $inicio->format('Y-m-d'),
                'fecha_fin' => $inicio->copy()->addDays(30)->format('Y-m-d'),
                'creado_en' => now(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => "$cantidad suscripciones creadas"
        ]);
    }






}