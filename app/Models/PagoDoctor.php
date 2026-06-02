<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagoDoctor extends Model
{
    protected $table = 'pagos_doctores';

    protected $fillable = [
        'doctor_id',
        'tipo_pago_id',
        'salario_mensual',
        'porcentaje_consulta',
        'renta_mensual',
        'observaciones'
    ];
}