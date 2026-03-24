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
Schema::create('citas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('doctor_id')->nullable()->constrained('doctores');
    $table->foreignId('paciente_id')->nullable()->constrained('pacientes');
    $table->foreignId('clinica_id')->nullable()->constrained('clinicas');
    $table->dateTime('fecha_inicio')->nullable();
    $table->dateTime('fecha_fin')->nullable();
    $table->string('estado', 30)->nullable();
    $table->string('motivo', 255)->nullable();
    $table->timestamp('creado_en')->nullable();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
