<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecetaDetalle extends Model
{
    protected $table = 'receta_detalle';
    public $timestamps = false;

protected $fillable = [
    'receta_id',
    'medicamento_id',
    'dosis',
    'frecuencia',
    'duracion',
    'instrucciones',
    'creado_en'
];

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }

    public function receta()
    {
        return $this->belongsTo(Receta::class);
    }
}