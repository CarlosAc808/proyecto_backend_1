<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorConsultorio extends Model
{
    protected $table = 'doctor_consultorios';

    protected $fillable = [
        'doctor_id',
        'consultorio_id',
        'fecha_inicio',
        'fecha_fin',
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