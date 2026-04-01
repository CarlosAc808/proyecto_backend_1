<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = 'notificaciones';

    protected $fillable = [
        'nombre',
        'descripcion',
        'canal',
        'activo'
    ];

    public $timestamps = false;

    // Relación
    public function usuarios()
    {
        return $this->belongsToMany(
            Usuario::class,
            'usuario_notificaciones',
            'notificacion_id',
            'usuario_id'
        )->withPivot('habilitado')->withTimestamps();
    }
}