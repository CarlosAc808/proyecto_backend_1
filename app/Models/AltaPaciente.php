<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Consulta;
class AltaPaciente extends Model
{
    protected $table = 'pacientes';

    protected $fillable = [
        'nombre',
        'apellidoP',
        'apellidoM',
        'nacimiento',
        'genero',
        'telefono',
        'correo',
        'direccion',
        'colonia',
        'ciudad',
        'estado',
        'codigoPostal',
        'tipoSangre',
        'alergias',
        'padecimientoHeredofamiliar'
    ];

        public function consultas()
    {
        return $this->hasMany(Consulta::class, 'paciente_id');
    }

    public function usuario()
{
    return $this->belongsTo(Usuario::class, 'usuario_id');
}
}