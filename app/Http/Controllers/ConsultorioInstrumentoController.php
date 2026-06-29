<?php

namespace App\Http\Controllers;

use App\Models\ConsultorioInstrumento;
use Illuminate\Http\Request;

class ConsultorioInstrumentoController extends Controller
{
  public function index()
    {
        return ConsultorioInstrumento::all();
    }

    public function inventario()
    {
        return ConsultorioInstrumento::with([
            'consultorio',
            'instrumento'
        ])->get();
    }

    public function store(Request $request)
    {
        $relacion =
        ConsultorioInstrumento::create([
            "consultorio_id" =>
            $request->consultorio_id,

            "instrumento_id" =>
            $request->instrumento_id,

            "cantidad" =>
            $request->cantidad
        ]);

        return response()->json([
            "success"=>true,
            "data"=>$relacion
        ]);
    }

    public function destroy($id)
    {
        ConsultorioInstrumento::destroy($id);

        return response()->json([
            "success"=>true
        ]);
    }
}