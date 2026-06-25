<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrdenCompra;
use App\Models\Medicamento;

class DetalleOrdenCompra extends Model
{
    use HasFactory;

    protected $table = 'detalle_ordenes_compra';

    protected $fillable = [
        'orden_compra_id',
        'medicamento_id',
        'medicamento_manual',
        'unidades',
        'descripcion',
    ];

    public function ordenCompra()
    {
        return $this->belongsTo(OrdenCompra::class, 'orden_compra_id');
    }

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class, 'medicamento_id');
    }
}