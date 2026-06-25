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
    Schema::table('usuarios', function (Blueprint $table) {
        // Quitamos ->change() para que cree la columna desde cero
        $table->enum('estado', ['activo', 'inactivo', 'cancelado'])
              ->default('activo');
    });
}

public function down(): void
{
    Schema::table('usuarios', function (Blueprint $table) {
        // En caso de revertir, simplemente eliminamos la columna creada
        $table->dropColumn('estado');
    });
}
};