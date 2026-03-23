<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AltaPaciente;
class Consulta extends Model
{
    protected $table = 'consultas';

    protected $fillable = [
        'cita_id', 
        'paciente_id',
        'motivo',
        'sintomas',
        'notas',
        'examen',
        'fecha_tratamiento'
    ];

        //  ESTA ES LA CLAVE
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = null;

    public function paciente()
    {
        return $this->belongsTo(AltaPaciente::class);
    }
}