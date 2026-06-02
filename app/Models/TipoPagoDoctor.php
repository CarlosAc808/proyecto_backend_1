<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPagoDoctor extends Model
{
    protected $table = 'tipos_pago_doctor';

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public $timestamps = false;
}