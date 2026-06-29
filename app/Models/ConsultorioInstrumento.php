<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\InstrumentoMedico as Instrumento;
use App\Models\Consultorio;

class ConsultorioInstrumento extends Model
{
    protected $table = "consultorio_instrumentos";

    protected $fillable = [
        'consultorio_id',
        'instrumento_id',
        'cantidad'
    ];


    public function consultorio()
{
    return $this->belongsTo(Consultorio::class);
}

public function instrumento()
{
    return $this->belongsTo(Instrumento::class);
}
}