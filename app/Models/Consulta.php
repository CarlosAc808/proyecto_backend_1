<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AltaPaciente;
class Consulta extends Model
{
    protected $table = 'consultas';

    protected $fillable = [
        'cita_id', 
        'doctor_id',
        'paciente_id',
        'motivo',
        'sintomas',
        'diagnostico',
        'notas_clinicas',
        'examen',
        'fecha_tratamiento',
    ];

    //  Laravel estándar
    public $timestamps = true;

    public function paciente()
    {
        return $this->belongsTo(AltaPaciente::class);
    }
}