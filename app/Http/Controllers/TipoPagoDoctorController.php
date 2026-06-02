<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use App\Models\TipoPagoDoctor;
use App\Models\HorarioDoctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoPagoDoctorController extends Controller
{
   public function index()
{
    return TipoPagoDoctor::all();
}

public function store(Request $request)
{
    $tipo = TipoPagoDoctor::create([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion
    ]);

    return response()->json($tipo);
}

public function destroy($id)
{
    TipoPagoDoctor::destroy($id);

    return response()->json([
        'message' => 'Tipo eliminado'
    ]);
}
}