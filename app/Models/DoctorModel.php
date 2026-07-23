<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorModel extends Model
{
    protected $table = "doctores";

    public $timestamps = false;

    protected $fillable = [
        'usuario_id',
        'clinica_id',
        'especialidad_id',
        'cedula_profesional',
        'anios_exp',
        'telefono'
    ];

    public function usuario()
    {
        return $this->belongsTo(
            Usuario::class,
            'usuario_id'
        );
    }

    public function especialidad()
    {
        return $this->belongsTo(
            Especialidad::class,
            'especialidad_id'
        );
    }

    public function horarios()
{
    return $this->hasMany(
        HorarioDoctor::class,
        'doctor_id'
    );
}

public function consultorios()
{
    return $this->hasMany(
        DoctorConsultorio::class,
        'doctor_id'
    );
}
public function asistencias()
{
    // Usamos el namespace completo de Asistencia para evitar errores de importación
    return $this->hasMany(\App\Models\Asistencia::class, 'doctor_id');
}


}