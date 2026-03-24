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
Schema::create('usuarios', function (Blueprint $table) {
    $table->id();
    $table->foreignId('rol_id')->constrained('roles');
    $table->string('nombre', 120);
    $table->string('correo', 150)->unique();
    $table->string('telefono', 20)->nullable();
    $table->text('foto_url')->nullable();
    $table->string('password')->nullable();
    $table->boolean('activo')->default(true);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
