<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class PerfilController extends Controller
{

public function obtenerPerfil($id)
{
    $usuario = Usuario::with('paciente')->find($id);

    if (!$usuario) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    return response()->json([
        'nombre' => $usuario->nombre,
        'correo' => $usuario->correo,

        // de pacientes
        'telefono' => $usuario->paciente->telefono ?? '',
        'fechaNacimiento' => $usuario->paciente->nacimiento ?? '',
        'direccion' => $usuario->paciente->direccion ?? '',
    ]);
}
}
