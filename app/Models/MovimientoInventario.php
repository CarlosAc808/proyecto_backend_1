<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoInventario extends Model
{
    protected $table = 'movimientos_inventario';
    public $timestamps = false;

    protected $fillable = [
        'inventario_id',
        'tipo',
        'cantidad',
        'motivo',
        'proveedor_id',
        'receta_id',
        'usuario_id',
        'fecha_movimiento'
    ];

    public function inventario()
    {
        return $this->belongsTo(Inventario::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Distribuidor::class, 'proveedor_id');
    }

    public function receta()
    {
        return $this->belongsTo(Receta::class);
    }
}