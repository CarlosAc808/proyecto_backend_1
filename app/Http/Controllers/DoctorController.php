<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\DoctorModel;

class DoctorController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'especialidad_id' => 'nullable|integer',
            'cedula_profesional' => 'required|string|max:30',
            'anios_exp' => 'nullable|integer',
            'telefono' => 'nullable|string|max:20'
        ]);

        $doctor = DoctorModel::create([
            'usuario_id' => 1, // temporal
            'clinica_id' => 1, // temporal
            'especialidad_id' => $request->especialidad_id,
            'cedula_profesional' => $request->cedula_profesional,
            'anios_exp' => $request->anios_exp,
            'telefono' => $request->telefono
        ]);

        return response()->json([
            "message" => "Doctor creado correctamente",
            "data" => $doctor
        ], 201);
    }
    //////////////////////////////
        public function index()
    {
        return response()->json(DoctorModel::all());
        ////////////////////////
    }
    public function update(Request $request, $id){
        $doctor = DoctorModel::findOrFail($id);
        $doctor->update($request->all());

        return response ()->json([
            "message" => "Doctor actualizado",
            "data"=> $doctor
        ]);
    }
    /////////////////
    public function destroy($id)
{
    $doctor = DoctorModel::findOrFail($id);
    $doctor->delete();

    return response()->json([
        "message" => "Doctor eliminado"
    ]);
}
}