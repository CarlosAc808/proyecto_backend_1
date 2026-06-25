<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Distribuidor;
use App\Models\DetalleOrdenCompra;

class OrdenCompra extends Model
{
    use HasFactory;

    protected $table = 'ordenes_compra';

    protected $fillable = [
        'proveedor_id',
        'fecha',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Distribuidor::class, 'proveedor_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleOrdenCompra::class, 'orden_compra_id');
    }
}