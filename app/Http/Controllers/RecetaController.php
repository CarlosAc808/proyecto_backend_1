<?php
namespace App\Http\Controllers;

use App\Models\Receta;

class RecetaController extends Controller
{
public function recetas()
{
    return response()->json(
        Receta::all()
    );
}
}