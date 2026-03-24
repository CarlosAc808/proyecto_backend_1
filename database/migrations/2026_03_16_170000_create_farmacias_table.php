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
Schema::create('farmacias', function (Blueprint $table) {
    $table->id();
    $table->foreignId('usuario_id')->unique()->constrained('usuarios');
    $table->foreignId('clinica_id')->constrained('clinicas');
    $table->string('nombre', 150)->nullable();
    $table->text('direccion')->nullable();
    $table->string('telefono', 20)->nullable();
    $table->timestamp('creado_en')->nullable();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmacias');
    }
};
