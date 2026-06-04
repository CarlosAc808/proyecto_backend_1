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
        Schema::create('medicamentos_caducados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventario_id')->constrained('inventario');
            $table->integer('cantidad');
            $table->string('motivo', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicamentos_caducados');
    }
};









