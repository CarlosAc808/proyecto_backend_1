<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'inventario';

    protected $fillable = [
        'farmacia_id',
        'medicamento_id',
        'distribuidor_id',
        'stock',
        'stock_minimo',
        'precio_compra',
        'precio_venta',
        'lote',
        'fecha_caducidad'
    ];

    public $timestamps = false;

    public function medicamento()
{
    return $this->belongsTo(Medicamento::class);
}
}
