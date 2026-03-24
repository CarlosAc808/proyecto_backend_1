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
Schema::create('clinicas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('usuario_id')->unique()->constrained('usuarios');
    $table->string('nombre', 150);
    $table->text('direccion')->nullable();
    $table->string('ciudad', 80)->nullable();
    $table->string('estado', 80)->nullable();
    $table->string('pais', 80)->default('México');
    $table->string('telefono', 20)->nullable();
    $table->timestamp('creado_en')->nullable();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinicas');
    }
};
