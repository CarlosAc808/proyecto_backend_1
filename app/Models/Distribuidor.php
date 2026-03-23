<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribuidor extends Model
{
    protected $table = 'distribuidores';

    public $timestamps = false; //  IMPORTANTE (no usas created_at)

    protected $fillable = [
        'farmacia_id',
        'nombre',
        'rfc',
        'categoria',
        'contacto',
        'correo',
        'telefono',
        'direccion',
        'ciudad',
        'creado_en'
    ];
}