<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialPago extends Model
{
    use HasFactory;

    protected $table = 'historial_pagos';

    protected $fillable = [
        'usuario_id',
        'monto',
        'fecha_pago',
        'metodo_pago',
        'estado',
    ];

    public function usuario()
    {
        // Apunta al modelo Usuario que acabas de mostrar
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}