<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\DoctorConsultorio;
use App\Models\HorarioDoctor;

class HorarioDoctorController extends Controller
{
public function store(Request $request)
{
    DB::beginTransaction();

    try {

        DoctorConsultorio::create([
            'doctor_id' => $request->doctor_id,
            'consultorio_id' => $request->consultorio_id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'activo' => true
        ]);

        foreach($request->horarios as $horario)
        {
            HorarioDoctor::create([
                'doctor_id' => $request->doctor_id,
                'consultorio_id' => $request->consultorio_id,
                'dia_semana' => $horario['dia_semana'],
                'hora_inicio' => $horario['hora_inicio'],
                'hora_fin' => $horario['hora_fin'],
                'activo' => true
            ]);
        }

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Asignación guardada'
        ]);

    } catch(\Exception $e){

        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ],500);
    }
}
}