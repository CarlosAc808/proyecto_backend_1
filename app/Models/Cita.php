<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = 'citas';

    protected $fillable = [
        'doctor_id',
        'paciente_id',
        'clinica_id',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'motivo',
        'creado_en'
    ];

    public $timestamps = false;

    // ============================
    // RELACIONES
    // ============================

    // Cita pertenece a Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    // Cita pertenece a Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    // Cita pertenece a Clínica
    public function clinica()
    {
        return $this->belongsTo(Clinica::class, 'clinica_id');
    }

    // Cita tiene una consulta
    public function consulta()
    {
        return $this->hasOne(Consulta::class, 'cita_id');
    }
}