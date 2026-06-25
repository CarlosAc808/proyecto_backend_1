<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HistorialSuscripcionesController extends Controller
{
    public function generarFake()
    {
        $suscripciones = DB::table('suscripciones')
            ->pluck('id')
            ->toArray();

        $planes = DB::table('planes')
            ->pluck('id')
            ->toArray();

        if (empty($suscripciones) || count($planes) < 2) {
            return response()->json([
                'message' => 'No hay suficientes suscripciones o planes'
            ], 400);
        }

        $registros = [];

        for ($i = 0; $i < 100; $i++) {

            $planAnterior = $planes[array_rand($planes)];

            do {
                $planNuevo = $planes[array_rand($planes)];
            } while ($planNuevo == $planAnterior);

            $registros[] = [
                'suscripcion_id' => $suscripciones[array_rand($suscripciones)],
                'previous_plan_id' => $planAnterior,
                'new_plan_id' => $planNuevo,
                'changed_type' => rand(0, 1)
                    ? 'upgrade'
                    : 'downgrade',
                'created_at' => Carbon::now()
                    ->subMonths(rand(0, 12))
                    ->subDays(rand(0, 30)),
            ];
        }

        DB::table('historial_suscripciones')->insert($registros);

        return response()->json([
            'message' => '100 registros generados correctamente'
        ]);
    }


    public function generarPagosFake()
{
    $usuarios = DB::table('usuarios')
        ->pluck('id')
        ->toArray();

    $planes = DB::table('planes')
        ->get();

    if (empty($usuarios) || $planes->isEmpty()) {
        return response()->json([
            'message' => 'No hay usuarios o planes registrados'
        ], 400);
    }

    $pagos = [];

    for ($i = 0; $i < 300; $i++) {

        $usuario = $usuarios[array_rand($usuarios)];

        $plan = $planes->random();

        $pagos[] = [
            'usuario_id' => $usuario,
            'monto' => $plan->precio,
            'fecha_pago' => Carbon::now()
                ->subMonths(rand(0, 12))
                ->subDays(rand(0, 28)),
            'metodo_pago' => collect([
                'Tarjeta',
                'PayPal',
                'Transferencia',
                'Efectivo'
            ])->random(),
            'estado' => collect([
                'pagado',
                'pagado',
                'pagado',
                'pendiente'
            ])->random(),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }

    DB::table('historial_pagos')->insert($pagos);

    return response()->json([
        'message' => '300 pagos generados correctamente'
    ]);
}

public function generarSuscripcionesFake()
{
    $usuarios = DB::table('usuarios')
        ->pluck('id')
        ->toArray();

    $planes = DB::table('planes')
        ->get();

    if (empty($usuarios) || $planes->isEmpty()) {
        return response()->json([
            'message' => 'No hay usuarios o planes registrados'
        ], 400);
    }

    $suscripciones = [];

    foreach ($usuarios as $usuarioId) {

        $plan = $planes->random();

        $fechaInicio = Carbon::now()
            ->subMonths(rand(0, 12))
            ->subDays(rand(0, 28));

        $estado = collect([
            'activo',
            'activo',
            'activo',
            'cancelado',
            'vencido'
        ])->random();

        if ($plan->precio == 0) {
            $fechaFin = $fechaInicio->copy()->addYears(10);
        } else {
            $fechaFin = $fechaInicio->copy()->addDays(
                $plan->duracion_dias
            );
        }

        $suscripciones[] = [
            'usuario_id' => $usuarioId,
            'plan_id' => $plan->id,
            'estado' => $estado,
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'creado_en' => now()
        ];
    }

    DB::table('suscripciones')->insert($suscripciones);

    return response()->json([
        'message' => count($suscripciones) . ' suscripciones generadas correctamente'
    ]);
}
}