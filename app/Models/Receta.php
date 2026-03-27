<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Paciente;
use App\Models\Consulta;
use App\Models\RecetaDetalle;

class Receta extends Model
{
    protected $table = 'recetas';
    public $timestamps = false;

protected $fillable = [
    'consulta_id',
    'doctor_id',
    'paciente_id',
    'farmacia_id',
    'estado',
    'creado_en'
];

    public function detalles()
    {
        return $this->hasMany(RecetaDetalle::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function consulta()
    {
        return $this->belongsTo(Consulta::class);
    }
}