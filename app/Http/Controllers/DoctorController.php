<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\DoctorModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Especialidad;


class DoctorController extends Controller
{
public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:120',
        'correo' => 'required|email|unique:usuarios,correo',
        'password' => 'required|min:6',
        'especialidad_id' => 'nullable|integer',
        'cedula_profesional' => 'required|string|max:30',
        'anios_exp' => 'nullable|integer',
        'telefono' => 'nullable|string|max:20',
        'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    DB::beginTransaction();

    try {

        // 🔹 1. Crear usuario
        $usuario = \App\Models\Usuario::create([
            'rol_id' => 3,
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'password' => Hash::make($request->password),
            'foto_url' => null
        ]);

        // 🔹 2. SUBIR FOTO (si existe)
        if ($request->hasFile('imagen')) {

            $archivo = $request->file('imagen');

            $nombre_archivo = 'usuario-' . $usuario->id . '.' . $archivo->getClientOriginalExtension();

            $archivo->storeAs('fotos/usuarios', $nombre_archivo, 'public');

            $usuario->foto_url = $nombre_archivo;
            $usuario->save();
        }

        // 🔹 3. Crear doctor
        $doctor = DoctorModel::create([
            'usuario_id' => $usuario->id,
            'clinica_id' => 1,
            'especialidad_id' => $request->especialidad_id,
            'cedula_profesional' => $request->cedula_profesional,
            'anios_exp' => $request->anios_exp,
            'telefono' => $request->telefono,
        ]);

        DB::commit();

        return response()->json([
            "message" => "Doctor creado correctamente",
            "usuario" => $usuario,
            "doctor" => $doctor
        ], 201);

    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            "message" => "Error",
            "error" => $e->getMessage()
        ], 500);
    }
}
       // 2. NUEVO INDEX UNIFICADO: Obtener doctores, relaciones y presencia en tiempo real
    public function index()
    {
        // Traemos los doctores con sus relaciones
        $doctores = DoctorModel::with(['usuario', 'especialidad'])->get();

        foreach ($doctores as $doctor) {
            // Evaluamos si tiene una entrada sin salida registrada en la tabla asistencias
            $activo = $doctor->asistencias()
                ->whereNull('hora_salida')
                ->exists();

            // Seteamos el estado dinámico que leerá React
            $doctor->estado_asistencia = $activo ? 'dentro' : 'fuera';
        }

        return response()->json($doctores);
    }

    // 3. Actualizar datos del doctor
    public function update(Request $request, $id)
    {
        $doctor = DoctorModel::findOrFail($id);
        $doctor->update($request->all());

        return response()->json([
            "message" => "Doctor actualizado",
            "data" => $doctor
        ]);
    }

    // 4. Eliminar doctor
    public function destroy($id)
    {
        $doctor = DoctorModel::findOrFail($id);
        $doctor->delete();

        return response()->json([
            "message" => "Doctor eliminado"
        ]);
    }

    // 5. Catálogo de especialidades para los selects del frontend
    public function getEspecialidades()
    {
        $especialidades = Especialidad::all();
        return response()->json($especialidades);
    }
 

}