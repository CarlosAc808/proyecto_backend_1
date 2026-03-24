<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('pacientes', function (Blueprint $table) {

        $table->id();

        // Información personal
        $table->string('nombre');
        $table->string('apellidoP');
        $table->string('apellidoM')->nullable();
        $table->date('nacimiento')->nullable();
        $table->string('genero')->nullable();

        // Contacto
        $table->string('telefono')->nullable();
        $table->string('correo')->nullable();
        $table->string('direccion')->nullable();
        $table->string('colonia')->nullable();
        $table->string('ciudad')->nullable();
        $table->string('estado')->nullable();
        $table->string('codigoPostal')->nullable();

        // Médico
        $table->string('tipoSangre')->nullable();
        $table->text('alergias')->nullable();
        $table->text('padecimientoHeredofamiliar')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alta_pacientes');
    }
};
