<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class UsuarioController extends Controller
{
    public function obtenerFotoUsuario($nombre)
{
    $path = 'public/fotos/usuarios/' . $nombre;

    if (!Storage::exists($path)) {
        return response()->json(['error' => 'Imagen no encontrada'], 404);
    }

    $file = Storage::get($path);
    $type = Storage::mimeType($path);

    return Response::make($file, 200)->header("Content-Type", $type);
}
}
