<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardFarmaciaController extends Controller
{
    public function index(Request $request)
    {
        $mes = $request->input('mes', date('Y-m'));

        // RANGO DE FECHAS
        $inicio = Carbon::parse($mes . '-01')->startOfMonth();
        $fin = Carbon::parse($mes . '-01')->endOfMonth();

        // ================================
        // MOVIMIENTOS
        // ================================
        $movimientos = DB::table('movimientos_inventario as m')
            ->join('inventario as i', 'm.inventario_id', '=', 'i.id')
            ->join('medicamentos as med', 'i.medicamento_id', '=', 'med.id')
            ->leftJoin('distribuidores as d', 'm.proveedor_id', '=', 'd.id')
            ->select(
                'm.id',
                DB::raw('DATE(m.fecha_movimiento) as fecha'),
                'med.nombre as medicamento',
                'd.nombre as proveedor',
                'm.tipo',
                'm.cantidad'
            )
            ->whereBetween('m.fecha_movimiento', [$inicio, $fin])
            ->orderBy('m.fecha_movimiento', 'desc')
            ->get();

        // ================================
        // ENTRADAS / SALIDAS
        // ================================
        $entradasMes = $movimientos->where('tipo', 'entrada')->sum('cantidad');
        $salidasMes = $movimientos->where('tipo', 'salida')->sum('cantidad');

        // ================================
        // INVENTARIO
        // ================================
        $inventario = DB::table('inventario as i')
            ->join('medicamentos as m', 'i.medicamento_id', '=', 'm.id')
            ->select(
                'm.nombre',
                'i.stock',
                'i.stock_minimo as minimo',
                DB::raw('DATEDIFF(i.fecha_caducidad, CURDATE()) as caducaEn')
            )
            ->get();

        $productosBajos = $inventario->where('stock', '<', 'minimo')->values();
        $proximosCaducar = $inventario->where('caducaEn', '<=', 15)->values();

        // ================================
        // RECETAS
        // ================================
        $recetas = DB::table('recetas as r')
            ->join('pacientes as p', 'r.paciente_id', '=', 'p.id')
            ->join('usuarios as u', 'p.usuario_id', '=', 'u.id')
            ->leftJoin('receta_detalle as rd', 'r.id', '=', 'rd.receta_id')
            ->leftJoin('medicamentos as m', 'rd.medicamento_id', '=', 'm.id')
            ->select(
                'r.id',
                'u.nombre as paciente',
                DB::raw('GROUP_CONCAT(m.nombre SEPARATOR ", ") as medicamento'),
                DB::raw('TIME(r.creado_en) as hora'),
                'r.estado as prioridad'
            )
            ->whereBetween('r.creado_en', [$inicio, $fin])
            ->groupBy('r.id', 'u.nombre', 'r.creado_en', 'r.estado')
            ->orderBy('r.creado_en', 'desc')
            ->get();

        // ================================
        // CONSUMO (TOP MEDICAMENTOS)
        // ================================
        $consumo = DB::table('movimientos_inventario as m')
            ->join('inventario as i', 'm.inventario_id', '=', 'i.id')
            ->join('medicamentos as med', 'i.medicamento_id', '=', 'med.id')
            ->select('med.nombre', DB::raw('SUM(m.cantidad) as total'))
            ->where('m.tipo', 'salida')
            ->whereBetween('m.fecha_movimiento', [$inicio, $fin])
            ->groupBy('med.nombre')
            ->orderByDesc('total')
            ->limit(5)
            ->get();


        // ================================
        // RECETAS (CON PAGINACIÓN)
        // ================================
        $perPage = $request->input('per_page', 5);

        $recetas = DB::table('recetas as r')
           ->join('pacientes as p', 'r.paciente_id', '=', 'p.id')
           ->join('usuarios as u', 'p.usuario_id', '=', 'u.id')
           ->leftJoin('receta_detalle as rd', 'r.id', '=', 'rd.receta_id')
           ->leftJoin('medicamentos as m', 'rd.medicamento_id', '=', 'm.id')
           ->select(
               'r.id',
               'u.nombre as paciente',
            DB::raw('GROUP_CONCAT(m.nombre SEPARATOR ", ") as medicamento'),
            DB::raw('TIME(r.creado_en) as hora'),
           'r.estado as prioridad'
            )
            ->whereBetween('r.creado_en', [$inicio, $fin])
            ->groupBy('r.id', 'u.nombre', 'r.creado_en', 'r.estado')
            ->orderBy('r.creado_en', 'desc')
            ->paginate($perPage);

        // ================================
        // RESPUESTA
        // ================================
        return response()->json([
            'movimientos' => $movimientos,
            'entradasMes' => $entradasMes,
            'salidasMes' => $salidasMes,
            'inventario' => $inventario,
            'productosBajos' => $productosBajos,
            'proximosCaducar' => $proximosCaducar,
            'recetas' => $recetas,
            'recetasPendientes' => $recetas->count(),
            'consumo' => $consumo
        ]);
    }
}