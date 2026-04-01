<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioNotificacion extends Model
{
    protected $table = 'usuario_notificaciones';

    protected $fillable = [
        'usuario_id',
        'notificacion_id',
        'habilitado',
        'canal'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function notificacion()
    {
        return $this->belongsTo(Notificacion::class);
    }
}