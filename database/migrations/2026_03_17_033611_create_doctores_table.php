<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('doctores', function (Blueprint $table) {

    $table->id();

    $table->unsignedBigInteger('usuario_id');
    $table->unsignedBigInteger('clinica_id');

    $table->unsignedBigInteger('especialidad_id')->nullable();

    $table->string('cedula_profesional',30);
    $table->integer('anios_exp')->nullable();
    $table->string('telefono',20)->nullable();

    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('doctores');
    }
};