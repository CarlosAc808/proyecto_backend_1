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
}