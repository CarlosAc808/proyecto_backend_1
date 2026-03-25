<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; //  IMPORTANTE

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
}