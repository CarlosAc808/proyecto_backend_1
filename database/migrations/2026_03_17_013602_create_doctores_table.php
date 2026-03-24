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
Schema::create('doctores', function (Blueprint $table) {
    $table->id();
    $table->foreignId('usuario_id')->unique()->constrained('usuarios');
    $table->foreignId('clinica_id')->constrained('clinicas');
    $table->foreignId('especialidad_id')->nullable()->constrained('especialidades');
    $table->string('cedula_profesional', 30)->nullable();
    $table->integer('anios_exp')->nullable();
    $table->string('telefono', 20)->nullable();
    $table->timestamp('creado_en')->nullable();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctores');
    }
};
