<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; //  IMPORTANTE
use App\Models\Notificacion;
use App\Models\UsuarioNotificacion;

class Usuario extends Authenticatable
{
    use HasApiTokens, Notifiable; //  AQUI TAMBIÉN

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'password',
        'rol_id',
        'activo'
    ];

    protected $hidden = [
        'password'
    ];

    public $timestamps = false;

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }
        public function paciente()
    {
        return $this->hasOne(Paciente::class, 'usuario_id');
    }
    public function notificaciones()
{
    return $this->belongsToMany(
        Notificacion::class,
        'usuario_notificaciones',
        'usuario_id',
        'notificacion_id'
    )->withPivot('habilitado')->withTimestamps();
}
}