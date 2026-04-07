<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Inventario;

class Medicamento extends Model
{
    protected $table = 'medicamentos';

    protected $fillable = [
        'nombre',
        'sustancia_activa',
        'concentracion',
        'unidad',
        'presentacion',
        'cantidad_presentacion',
        'requiere_receta',
        'descripcion_general',
        'imagen_url'
    ];

    public $timestamps = false;

    public function inventario()
{
    return $this->hasOne(Inventario::class, 'medicamento_id');
}
}
