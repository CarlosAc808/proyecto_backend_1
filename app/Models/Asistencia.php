<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencias';

    protected $fillable = [
        'doctor_id',
        'fecha',
        'hora_entrada',
        'hora_salida',
        'horas_trabajadas'
    ];

    // Relación inversa: Una asistencia pertenece a un doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}