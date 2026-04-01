<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificacionesController extends Controller
{
public function obtenerNotificaciones($usuario_id)
{
    // verificar si ya tiene registros
    $existe = DB::table('usuario_notificaciones')
        ->where('usuario_id', $usuario_id)
        ->exists();

    // si no tiene, crearlos automáticamente
    if (!$existe) {
        $notificaciones = DB::table('notificaciones')->get();

        foreach ($notificaciones as $n) {
            DB::table('usuario_notificaciones')->insert([
                'usuario_id' => $usuario_id,
                'notificacion_id' => $n->id,
                'habilitado' => 0
            ]);
        }
    }

    return DB::table('usuario_notificaciones')
        ->join('notificaciones', 'notificaciones.id', '=', 'usuario_notificaciones.notificacion_id')
        ->where('usuario_notificaciones.usuario_id', $usuario_id)
        ->select(
            'notificaciones.id',
            'notificaciones.nombre',
            'usuario_notificaciones.habilitado'
        )
        ->get();
}

    public function toggleNotificacion(Request $request)
    {
        $registro = DB::table('usuario_notificaciones')
            ->where('usuario_id', $request->usuario_id)
            ->where('notificacion_id', $request->notificacion_id)
            ->first();

        // SI NO EXISTE → CREAR
        if (!$registro) {
            DB::table('usuario_notificaciones')->insert([
                'usuario_id' => $request->usuario_id,
                'notificacion_id' => $request->notificacion_id,
                'habilitado' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return response()->json(['created' => true]);
        }

        // SI EXISTE → TOGGLE
        DB::table('usuario_notificaciones')
            ->where('id', $registro->id)
            ->update([
                'habilitado' => !$registro->habilitado,
                'updated_at' => now()
            ]);

        return response()->json(['success' => true]);
    }

    public function inicializarNotificaciones($usuario_id)
{
    $notificaciones = DB::table('notificaciones')->get();

    foreach ($notificaciones as $n) {
        DB::table('usuario_notificaciones')->insert([
            'usuario_id' => $usuario_id,
            'notificacion_id' => $n->id,
            'habilitado' => 0 // por defecto desactivado
        ]);
    }
}
}  