<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            
            // Llave foránea hacia tu tabla 'doctores'
            $table->foreignId('doctor_id')
                  ->constrained('doctores')
                  ->onDelete('cascade');

            $table->date('fecha'); // Ejemplo: 2026-06-18
            $table->time('hora_entrada'); // Ejemplo: 08:30:00
            $table->time('hora_salida')->nullable(); // Ejemplo: 17:15:00
            $table->string('horas_trabajadas')->nullable(); // Ejemplo: "08h 45m"

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};