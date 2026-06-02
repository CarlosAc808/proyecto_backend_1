<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorarioDoctor extends Model
{
    protected $table = 'horarios_doctores';

    protected $fillable = [
        'doctor_id',
        'consultorio_id',
        'dia_semana',
        'hora_inicio',
        'hora_fin',
        'activo'
    ];

    public function doctor()
    {
        return $this->belongsTo(
            DoctorModel::class,
            'doctor_id'
        );
    }

    public function consultorio()
    {
        return $this->belongsTo(
            Consultorio::class,
            'consultorio_id'
        );
    }
}