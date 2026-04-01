<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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


public function cambiarPassword(Request $request)
{
    $usuario = Usuario::find($request->usuario_id);

    if (!$usuario) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    if (!Hash::check($request->actual, $usuario->password)) {
        return response()->json(['error' => 'Contraseña actual incorrecta'], 400);
    }

    $usuario->password = bcrypt($request->nueva);
    $usuario->save();

    return response()->json(['success' => true]);
}


public function obtenerDoctor($usuario_id)
{
    $usuario = Usuario::with('paciente.doctor.especialidad')->find($usuario_id);

    if (!$usuario || !$usuario->paciente || !$usuario->paciente->doctor) {
        return response()->json(['error' => 'Doctor no encontrado'], 404);
    }

    $doctor = $usuario->paciente->doctor;

    return response()->json([
        'nombre' => $doctor->usuario->nombre ?? '',
        'especialidad' => $doctor->especialidad->nombre ?? '',
    ]);
}


public function actualizarPerfil(Request $request)
{
    $usuario = Usuario::find($request->usuario_id);

    if (!$usuario) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    // =========================
    // DATOS NORMALES
    // =========================
    $usuario->nombre = $request->nombre;
    $usuario->correo = $request->correo;

    // =========================
    // IMAGEN
    // =========================
if ($request->hasFile('imagen')) {

    $archivo = $request->file('imagen');

    // borrar imagen anterior
    if ($usuario->foto_url) {
        Storage::disk('public')->delete('fotos/usuarios/' . $usuario->foto_url);
    }

    // nombre archivo
    $nombre_archivo = 'usuario-' . $usuario->id . '.' . $archivo->getClientOriginalExtension();

    // guardar archivo
    $archivo->storeAs('fotos/usuarios', $nombre_archivo, 'public');

    // guardar en BD
    $usuario->foto_url = $nombre_archivo;
}

$usuario->save();

    // =========================
    // PACIENTE
    // =========================
    if ($usuario->paciente) {
        $usuario->paciente->telefono = $request->telefono;
        $usuario->paciente->nacimiento = $request->fechaNacimiento;
        $usuario->paciente->direccion = $request->direccion;
        $usuario->paciente->save();
    }

return response()->json([
    'success' => true,
    'imagen' => $usuario->foto_url
]);
}
}
