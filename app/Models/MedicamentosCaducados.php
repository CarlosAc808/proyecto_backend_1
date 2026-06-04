<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicamentosCaducados extends Model
{
    protected $table = 'medicamentos_caducados';
    public $timestamps = false;

    protected $fillable = [
        'inventario_id',
        'cantidad',
        'motivo',
    ];

    public function inventario()
    {
        return $this->belongsTo(Inventario::class);
    }
}