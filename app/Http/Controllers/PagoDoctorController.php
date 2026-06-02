<?php

namespace App\Http\Controllers;

use App\Models\PagoDoctor;
use Illuminate\Http\Request;

class PagoDoctorController extends Controller
{
    public function store(Request $request)
    {
        $tipo = $request->tipo_pago_id;

        $data = [
            'doctor_id' => $request->doctor_id,
            'tipo_pago_id' => $tipo,
            'observaciones' => $request->observaciones
        ];

        switch ($tipo) {

            case 1:
                $data['salario_mensual'] = $request->monto;
                break;

            case 2:
                $data['renta_mensual'] = $request->monto;
                break;

            case 3:
                $data['porcentaje_consulta'] = $request->monto;
                break;

            case 4:
                $data['salario_mensual'] = $request->salario;
                $data['porcentaje_consulta'] = $request->porcentaje;
                break;
        }

        $pago = PagoDoctor::create($data);

        return response()->json($pago);
    }
}