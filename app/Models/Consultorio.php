<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultorio extends Model
{
    protected $table = 'consultorios';

    protected $fillable = [
        'clinica_id',
        'nombre',
        'numero',
        'piso',
        'descripcion',
        'activo'
    ];

    public function horarios()
{
    return $this->hasMany(
        HorarioDoctor::class,
        'consultorio_id'
    );
}

public function doctores()
{
    return $this->hasMany(
        DoctorConsultorio::class,
        'consultorio_id'
    );
}
}